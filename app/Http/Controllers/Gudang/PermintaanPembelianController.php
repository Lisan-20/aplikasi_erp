<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Pengadaan\TcErpPr;
use App\Models\Pengadaan\TcErpPrDetail;
use App\Models\Master\MtErpSupplier;

class PermintaanPembelianController extends Controller
{
    public function index(Request $request)
    {
        $query = TcErpPr::query()
            ->leftJoin('mt_erp_supplier', 'tc_erp_pr.supplier_id', '=', 'mt_erp_supplier.id')
            ->select(
                'tc_erp_pr.id',
                'tc_erp_pr.no_pr as kode_permohonan',
                'tc_erp_pr.tgl_pr as tgl_permohonan',
                'tc_erp_pr.status',
                'mt_erp_supplier.nama_supplier'
            )
            ->where('tc_erp_pr.status', '!=', 3) // Exclude Batal
            ->orderBy('tc_erp_pr.tgl_pr', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tc_erp_pr.no_pr', 'like', "%{$search}%")
                    ->orWhere('mt_erp_supplier.nama_supplier', 'like', "%{$search}%");
            });
        }

        $prs = $query->paginate(20)->withQueryString();

        // Get total items for each PR
        $prIds = collect($prs->items())->pluck('id');
        if ($prIds->isNotEmpty()) {
            $counts = TcErpPrDetail::whereIn('pr_id', $prIds)
                ->select('pr_id', DB::raw('count(*) as jml_brg'))
                ->groupBy('pr_id')
                ->get()
                ->keyBy('pr_id');

            // Find if PR has an approved PO
            $approvedPrs = DB::table('tc_erp_pr_detail as prd')
                ->join('tc_erp_po_detail as pod', 'prd.id', '=', 'pod.pr_detail_id')
                ->join('tc_erp_po as po', 'pod.po_id', '=', 'po.id')
                ->whereIn('prd.pr_id', $prIds)
                ->where('po.status', '>=', 1) // 1 = ACC by management
                ->select('prd.pr_id', 'po.no_po', 'po.tgl_acc')
                ->get()
                ->keyBy('pr_id');

            foreach ($prs->items() as $item) {
                $item->jml_brg = isset($counts[$item->id]) ? $counts[$item->id]->jml_brg : 0;
                
                if (isset($approvedPrs[$item->id])) {
                    $item->no_acc = 'ACC';
                    $item->tgl_acc = $approvedPrs[$item->id]->tgl_acc;
                } else {
                    $item->no_acc = null;
                    $item->tgl_acc = null;
                }
            }
        }

        return Inertia::render('Gudang/PermintaanPembelian/Index', [
            'prs' => $prs,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Gudang/PermintaanPembelian/FormPermintaan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodesupplier' => 'required',
            'items' => 'required|array|min:1',
            'items.*.kode_brg' => 'required',
            'items.*.jumlah_besar' => 'required|numeric|min:1',
        ]);

        try {
            DB::beginTransaction();

            $month = Carbon::now()->format('m');
            $year = Carbon::now()->format('Y');

            $lastPr = TcErpPr::whereYear('tgl_pr', $year)
                ->orderBy('id', 'desc')
                ->first();

            $nextNum = 1;
            if ($lastPr && preg_match('/^(\d+)\//', $lastPr->no_pr, $matches)) {
                $nextNum = intval($matches[1]) + 1;
            }

            $noPr = sprintf('%d/PR/%s/%s', $nextNum, $month, $year);

            // supplier_id from kodesupplier (frontend might send ID if updated, or kodesupplier)
            // Let's assume kodesupplier is actually the ID for the new mt_erp_supplier table, 
            // since we will update the search-supplier API to return the ID.

            $pr = TcErpPr::create([
                'no_pr' => $noPr,
                'tgl_pr' => Carbon::now(),
                'status' => 1, // 1 = Diajukan
                'user_id' => 1, // hardcode for now
                'supplier_id' => $request->kodesupplier,
            ]);

            $details = [];
            foreach ($request->items as $item) {
                $details[] = [
                    'pr_id' => $pr->id,
                    'kode_brg' => $item['kode_brg'],
                    'qty_minta' => $item['jumlah_besar'],
                    'qty_po' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            TcErpPrDetail::insert($details);

            DB::commit();

            return redirect('/gudang/permintaan-pembelian')->with('success', 'Permintaan Pembelian berhasil dibuat dengan Kode: '.$noPr);

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal menyimpan Permintaan Pembelian: '.$e->getMessage()]);
        }
    }
}

