<?php

namespace App\Http\Controllers\Pengadaan;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Pengadaan\TcErpPo;
use App\Models\Pengadaan\TcErpPoDetail;
use App\Models\Pengadaan\TcErpPr;
use App\Models\Pengadaan\TcErpPrDetail;
use App\Models\Master\MtErpSupplier;

class PengadaanController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'penerbitan'); // penerbitan, revisi, history

        $query = TcErpPo::query()
            ->with('supplier')
            ->orderBy('tgl_po', 'desc');

        if ($tab === 'penerbitan') {
            $query->whereIn('status', [0]); // Draft/Penerbitan
        } elseif ($tab === 'revisi') {
            $query->where('status', 2); // Revisi
        } else {
            // History: ACC, Batal, Selesai (1, 3, 4)
            $query->whereIn('status', [1, 3, 4]);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_po', 'like', "%{$search}%")
                  ->orWhereHas('supplier', function ($sq) use ($search) {
                      $sq->where('nama_supplier', 'like', "%{$search}%");
                  });
            });
        }

        $pos = $query->paginate(20)->withQueryString();

        return Inertia::render('Pengadaan/PO/Index', [
            'pos' => $pos,
            'filters' => $request->only(['search', 'tab']),
            'activeTab' => $tab,
        ]);
    }

    public function create()
    {
        return Inertia::render('Pengadaan/PO/FormPo');
    }

    public function searchSupplier(Request $request)
    {
        $query = DB::table('mt_erp_supplier')->where('is_active', 1);
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_supplier', 'like', "%{$request->search}%");
        }
        $suppliers = $query->take(50)->get(['id as kodesupplier', 'nama_supplier as namasupplier']);

        return response()->json($suppliers);
    }

    public function searchPR(Request $request)
    {
        $query = TcErpPr::query()
            ->with(['details' => function($q) {
                // only details that still need to be PO'd
                $q->whereRaw('qty_po < qty_minta');
            }])
            ->where('status', 1); // Diajukan

        if ($request->has('search') && $request->search != '') {
            $query->where('no_pr', 'like', "%{$request->search}%");
        }

        $prs = $query->get();

        $grouped = [];
        foreach ($prs as $pr) {
            $items = [];
            foreach ($pr->details as $det) {
                // Fetch nama_brg from mt_barang_jasa
                $brg = DB::table('mt_barang_jasa')->where('kode_brg', $det->kode_brg)->first();
                $items[] = [
                    'id_tc_permohonan_det' => $det->id,
                    'kode_brg' => $det->kode_brg,
                    'nama_brg' => $brg ? $brg->nama_brg : $det->kode_brg,
                    'qty' => $det->qty_minta - $det->qty_po,
                    'satuan_besar' => $brg ? $brg->satuan_besar : '',
                    'harga_beli' => 0, 
                ];
            }
            if (count($items) > 0) {
                $grouped[] = [
                    'id_tc_permohonan' => $pr->id,
                    'kode_permohonan' => $pr->no_pr,
                    'kodesupplier' => $pr->supplier_id,
                    'items' => $items,
                ];
            }
        }

        return response()->json($grouped);
    }

    public function searchBarang(Request $request)
    {
        $query = DB::table('mt_barang_jasa')
            ->select('kode_brg', 'nama_brg', 'satuan_besar as satuan')
            ->where('status', 1)
            ->where('kd_tipe_brg', 1);

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_brg', 'like', "%{$request->search}%");
        }

        $barang = $query->take(20)->get();

        return response()->json($barang);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodesupplier' => 'required',
            'tgl_po' => 'required|date',
            'cart' => 'required|array|min:1',
            'cart.*.kode_brg' => 'required',
            'cart.*.qty' => 'required|numeric|min:1',
            'cart.*.harga_beli' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $month = Carbon::parse($request->tgl_po)->format('m');
            $year = Carbon::parse($request->tgl_po)->format('Y');

            $lastPo = TcErpPo::whereYear('tgl_po', $year)
                ->orderBy('id', 'desc')
                ->first();

            $nextNum = 1;
            if ($lastPo && preg_match('/^(\d+)\//', $lastPo->no_po, $matches)) {
                $nextNum = intval($matches[1]) + 1;
            }

            $noPo = sprintf('%d/PO/%s/%s', $nextNum, $month, $year);

            $po = TcErpPo::create([
                'no_po' => $noPo,
                'tgl_po' => $request->tgl_po,
                'supplier_id' => $request->kodesupplier,
                'ppn_persen' => $request->ppn ?? 0,
                'ppn_nominal' => $request->ppn_nominal ?? 0,
                'diskon_nominal' => $request->discount_harga ?? 0,
                'total_sbl_ppn' => $request->total_sbl_ppn ?? 0,
                'total_stl_ppn' => $request->total_stl_ppn ?? 0,
                'status' => 0, // 0 = Draft/Penerbitan (Menunggu ACC)
                'user_id' => auth()->id() ?? 1,
            ]);

            $details = [];
            foreach ($request->cart as $item) {
                $details[] = [
                    'po_id' => $po->id,
                    'pr_detail_id' => $item['id_tc_permohonan_det'] ?? null,
                    'kode_brg' => $item['kode_brg'],
                    'qty_pesan' => $item['qty'],
                    'harga_satuan' => $item['harga_beli'],
                    'diskon' => $item['diskon'] ?? 0,
                    'subtotal' => $item['subtotal'] ?? ($item['qty'] * $item['harga_beli']),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                // Update PR qty_po if linked
                if (!empty($item['id_tc_permohonan_det'])) {
                    TcErpPrDetail::where('id', $item['id_tc_permohonan_det'])
                        ->increment('qty_po', $item['qty']);
                    
                    // Mark PR as processed if all items are fully PO'd (Optional logic)
                    $prId = TcErpPrDetail::where('id', $item['id_tc_permohonan_det'])->value('pr_id');
                    $prDetails = TcErpPrDetail::where('pr_id', $prId)->get();
                    $allProcessed = true;
                    foreach($prDetails as $d) {
                        if ($d->qty_po < $d->qty_minta) {
                            $allProcessed = false;
                        }
                    }
                    if ($allProcessed) {
                        TcErpPr::where('id', $prId)->update(['status' => 2]); // Diproses PO
                    }
                }
            }

            TcErpPoDetail::insert($details);

            DB::commit();

            return redirect('/pengadaan/po')->with('success', 'PO berhasil diterbitkan dengan nomor: '.$noPo);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan PO: '.$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $po = TcErpPo::findOrFail($id);

        DB::beginTransaction();
        try {
            if ($po->status == 0 || $po->status == 2) {
                // Return PR status to 1
                $poDetails = TcErpPoDetail::where('po_id', $po->id)->get();
                $prIds = [];
                foreach ($poDetails as $det) {
                    if ($det->pr_detail_id) {
                        $prDetail = \App\Models\Pengadaan\TcErpPrDetail::find($det->pr_detail_id);
                        if ($prDetail) {
                            $prDetail->decrement('qty_po', $det->qty_po);
                            $prId = $prDetail->pr_id;
                            if ($prId && !in_array($prId, $prIds)) {
                                $prIds[] = $prId;
                            }
                        }
                    }
                }
                
                foreach ($prIds as $prId) {
                    \App\Models\Pengadaan\TcErpPr::where('id', $prId)->update(['status' => 1]);
                }
                
                TcErpPoDetail::where('po_id', $po->id)->delete();
                $po->delete();
            } else {
                return redirect()->back()->withErrors(['error' => 'Hanya PO dalam status Penerbitan atau Revisi yang bisa dihapus.']);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Purchase Order berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $po = TcErpPo::findOrFail($id);
        if ($po->status != 2) {
            return redirect()->route('po.index')->withErrors(['error' => 'Hanya PO dengan status Revisi yang dapat diubah.']);
        }
        return $this->renderPoForm('Pengadaan/PO/EditPo', $po);
    }

    public function show($id)
    {
        $po = TcErpPo::findOrFail($id);
        return $this->renderPoForm('Pengadaan/PO/ShowPo', $po);
    }

    private function renderPoForm($view, $po)
    {

        // Fetch supplier
        $supplier = DB::table('mt_supplier')->where('id', $po->supplier_id)->first();
        
        // Fetch details
        $details = DB::table('tc_erp_po_det')
            ->where('id_tc_po', $po->id)
            ->get();
            
        $cart = [];
        $prIds = [];
        foreach ($details as $det) {
            $brg = DB::table('mt_barang_jasa')->where('kode_brg', $det->kode_brg)->first();
            $cart[] = [
                'id_tc_permohonan_det' => $det->id_tc_permohonan_det,
                'kode_brg' => $det->kode_brg,
                'nama_brg' => $brg ? $brg->nama_brg : $det->kode_brg,
                'qty' => $det->qty_po,
                'satuan_besar' => $det->satuan,
                'harga_beli' => $det->harga_satuan,
            ];
            if ($det->id_tc_permohonan && !in_array($det->id_tc_permohonan, $prIds)) {
                $prIds[] = $det->id_tc_permohonan;
            }
        }
        
        // Note: For simplicity in the UI, if multiple PRs were merged, we might only show the first one in the dropdown,
        // but the cart holds all items. We will pass a dummy selectedPr.
        $selectedPr = null;
        if (count($prIds) > 0) {
            $pr = TcErpPr::find($prIds[0]);
            if ($pr) {
                $selectedPr = [
                    'value' => $pr->id,
                    'label' => $pr->no_pr . ' - ' . count($cart) . ' Barang'
                ];
            }
        }

        return Inertia::render($view, [
            'po' => $po,
            'cart' => $cart,
            'supplier' => $supplier ? ['kodesupplier' => $supplier->id, 'namasupplier' => $supplier->nama_supplier] : null,
            'selectedPr' => $selectedPr
        ]);
    }

    public function revisiStore(Request $request, $id)
    {
        // For actual revision update logic
        // This acts as a re-save of PO
        $request->validate([
            'kodesupplier' => 'required',
            'cart' => 'required|array|min:1',
        ]);

        try {
            DB::beginTransaction();
            $po = TcErpPo::findOrFail($id);
            if ($po->status != 2 && $po->status != 0) {
                throw new \Exception("PO tidak bisa direvisi");
            }
            
            // Revert old PR qtys
            $oldDetails = TcErpPoDetail::where('po_id', $po->id)->get();
            foreach($oldDetails as $det) {
                if ($det->pr_detail_id) {
                    TcErpPrDetail::where('id', $det->pr_detail_id)->decrement('qty_po', $det->qty_pesan);
                }
            }
            TcErpPoDetail::where('po_id', $po->id)->delete();

            // Update PO
            $po->supplier_id = $request->kodesupplier;
            $po->ppn_persen = $request->ppn ?? 0;
            $po->ppn_nominal = $request->ppn_nominal ?? 0;
            $po->diskon_nominal = $request->discount_harga ?? 0;
            $po->total_sbl_ppn = $request->total_sbl_ppn ?? 0;
            $po->total_stl_ppn = $request->total_stl_ppn ?? 0;
            $po->status = 0; // Return to draft/penerbitan to request ACC again
            $po->save();

            $details = [];
            foreach ($request->cart as $item) {
                $details[] = [
                    'po_id' => $po->id,
                    'pr_detail_id' => $item['id_tc_permohonan_det'] ?? null,
                    'kode_brg' => $item['kode_brg'],
                    'qty_pesan' => $item['qty'],
                    'harga_satuan' => $item['harga_beli'],
                    'subtotal' => $item['subtotal'] ?? ($item['qty'] * $item['harga_beli']),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                if (!empty($item['id_tc_permohonan_det'])) {
                    TcErpPrDetail::where('id', $item['id_tc_permohonan_det'])->increment('qty_po', $item['qty']);
                }
            }
            TcErpPoDetail::insert($details);

            DB::commit();
            return redirect('/pengadaan/po?tab=penerbitan')->with('success', 'PO berhasil direvisi dan diajukan ulang.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal merevisi PO: '.$e->getMessage()]);
        }
    }
}
