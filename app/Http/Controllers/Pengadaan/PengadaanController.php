<?php

namespace App\Http\Controllers\Pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;

class PengadaanController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('tc_permohonan_nm as a')
            ->leftJoin('mt_supplier as b', 'a.kodesupplier', '=', 'b.kodesupplier')
            ->select(
                'a.id_tc_permohonan',
                'a.kode_permohonan',
                'a.tgl_permohonan',
                'a.status_batal',
                'a.status_kirim',
                'a.no_acc',
                'a.tgl_acc',
                'b.namasupplier as nama_supplier'
            )
            ->where('a.status_batal', 0)
            ->orderBy('a.tgl_permohonan', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('a.kode_permohonan', 'like', "%{$search}%")
                  ->orWhere('b.namasupplier', 'like', "%{$search}%");
            });
        }

        $prs = $query->paginate(20)->withQueryString();

        // Get total items for each PR
        $prIds = collect($prs->items())->pluck('id_tc_permohonan');
        if ($prIds->isNotEmpty()) {
            $counts = DB::table('tc_permohonan_nm_det')
                ->whereIn('id_tc_permohonan', $prIds)
                ->where('status_batal', 0)
                ->select('id_tc_permohonan', DB::raw('count(*) as jml_brg'))
                ->groupBy('id_tc_permohonan')
                ->get()
                ->keyBy('id_tc_permohonan');

            foreach ($prs->items() as $item) {
                $item->jml_brg = isset($counts[$item->id_tc_permohonan]) ? $counts[$item->id_tc_permohonan]->jml_brg : 0;
            }
        }

        return Inertia::render('Gudang/PermintaanPembelian/Index', [
            'prs' => $prs,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Pengadaan/PO/FormPo');
    }

    public function searchSupplier(Request $request)
    {
        $query = DB::table('mt_supplier')->where('status', 1);
        if ($request->has('search') && $request->search != '') {
            $query->where('namasupplier', 'like', "%{$request->search}%");
        }
        $suppliers = $query->take(50)->get(['kodesupplier', 'namasupplier']);
        return response()->json($suppliers);
    }

    public function searchPR(Request $request)
    {
        $query = DB::table('tc_permohonan_nm as a')
            ->join('tc_permohonan_nm_det as b', 'a.id_tc_permohonan', '=', 'b.id_tc_permohonan')
            ->join('mt_barang_nm as c', 'b.kode_brg', '=', 'c.kode_brg')
            ->whereNotNull('a.no_acc')
            ->where('a.status_batal', 0)
            ->where('b.status_batal', 0)
            ->where(function($q) {
                $q->whereNull('b.status_po')->orWhere('b.status_po', 0);
            })
            ->select(
                'a.id_tc_permohonan',
                'a.kode_permohonan',
                'a.kodesupplier',
                'b.id_tc_permohonan_det',
                'b.kode_brg',
                'c.nama_brg',
                'b.jumlah_besar as qty',
                'b.satuan as satuan_besar'
            );
            
        if ($request->has('search') && $request->search != '') {
            $query->where('a.kode_permohonan', 'like', "%{$request->search}%");
        }
        
        $prs = $query->get();
        
        // Group by PR
        $grouped = [];
        foreach ($prs as $pr) {
            if (!isset($grouped[$pr->id_tc_permohonan])) {
                $grouped[$pr->id_tc_permohonan] = [
                    'id_tc_permohonan' => $pr->id_tc_permohonan,
                    'kode_permohonan' => $pr->kode_permohonan,
                    'kodesupplier' => $pr->kodesupplier,
                    'items' => []
                ];
            }
            $grouped[$pr->id_tc_permohonan]['items'][] = [
                'id_tc_permohonan_det' => $pr->id_tc_permohonan_det,
                'kode_brg' => $pr->kode_brg,
                'nama_brg' => $pr->nama_brg,
                'qty' => $pr->qty,
                'satuan_besar' => $pr->satuan_besar,
                'harga_beli' => 0 // to be filled by user
            ];
        }
        
        return response()->json(array_values($grouped));
    }

    public function searchBarang(Request $request)
    {
        $query = DB::table('mt_barang_nm')
            ->select('kode_brg', 'nama_brg', 'satuan_besar as satuan');
            
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
            'ppn' => 'numeric|min:0|max:100',
            'discount_harga' => 'numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $date = Carbon::parse($request->tgl_po);
            // Generate PO Number
            // Format: PO-NM-YYYYMMDD-XXXX
            $countToday = DB::table('tc_po_nm')
                ->whereDate('tgl_po', $date->toDateString())
                ->count();
            $no_po = 'PO-NM-' . $date->format('Ymd') . '-' . str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

            $total_sbl_ppn = 0;
            $discount_harga = $request->discount_harga ?? 0;

            foreach ($request->cart as $item) {
                $total_sbl_ppn += ($item['qty'] * $item['harga_beli']);
            }

            $total_sbl_ppn -= $discount_harga;
            $ppn_percent = $request->ppn ?? 0;
            $ppn_amount = ($total_sbl_ppn * $ppn_percent) / 100;
            $total_stl_ppn = $total_sbl_ppn + $ppn_amount;

            $id_tc_po = DB::table('tc_po_nm')->insertGetId([
                'no_po' => $no_po,
                'tgl_po' => $date->toDateTimeString(),
                'kodesupplier' => $request->kodesupplier,
                'ppn' => $ppn_amount,
                'total_sbl_ppn' => $total_sbl_ppn,
                'total_stl_ppn' => $total_stl_ppn,
                'discount_harga' => $discount_harga,
                'status_kirim' => 0, // 0 = belum kirim, 1 = kirim parsial, 2 = kirim full
                'status_batal' => 0,
                'petugas' => auth()->user()->nama_pegawai ?? 'System',
                'user_id' => auth()->id(),
            ]);

            foreach ($request->cart as $item) {
                $jumlah_harga = $item['qty'] * $item['harga_beli'];
                DB::table('tc_po_nm_det')->insert([
                    'id_tc_po' => $id_tc_po,
                    'id_tc_permohonan' => $item['id_tc_permohonan'] ?? null,
                    'id_tc_permohonan_det' => $item['id_tc_permohonan_det'] ?? null,
                    'kode_brg' => $item['kode_brg'],
                    'jumlah_besar' => $item['qty'],
                    'harga_satuan' => $item['harga_beli'],
                    'harga_satuan_netto' => $item['harga_beli'],
                    'jumlah_harga' => $jumlah_harga,
                    'jumlah_harga_netto' => $jumlah_harga,
                    'satuan' => $item['satuan_besar'] ?? '-',
                    'status_batal' => 0,
                    'status_close' => 0
                ]);
                
                // Update PR status_po
                if (isset($item['id_tc_permohonan_det'])) {
                    DB::table('tc_permohonan_nm_det')
                        ->where('id_tc_permohonan_det', $item['id_tc_permohonan_det'])
                        ->update(['status_po' => 1]);
                }
            }

            DB::commit();

            return redirect()->route('pengadaan.po.index')->with('success', "PO $no_po berhasil dibuat!");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat PO: ' . $e->getMessage());
        }
    }
}
