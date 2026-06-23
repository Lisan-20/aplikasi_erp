<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AccPurchasingController extends Controller
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
                'a.kodesupplier',
                'b.namasupplier as nama_supplier'
            )
            ->where('a.status_batal', 0)
            ->orderBy('a.tgl_permohonan', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('a.kode_permohonan', 'like', "%{$search}%")
                    ->orWhere('b.namasupplier', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'belum') {
                $query->whereNull('a.no_acc');
            } elseif ($request->status == 'sudah') {
                $query->whereNotNull('a.no_acc');
            }
        } else {
            // Default show only pending
            $query->whereNull('a.no_acc');
        }

        $prs = $query->paginate(20)->withQueryString();

        // Get details for PRs to show in modal
        $prIds = collect($prs->items())->pluck('id_tc_permohonan');
        if ($prIds->isNotEmpty()) {
            $details = DB::table('tc_permohonan_nm_det as a')
                ->join('mt_barang_jasa as b', 'a.kode_brg', '=', 'b.kode_brg')
                ->whereIn('a.id_tc_permohonan', $prIds)
                ->where('a.status_batal', 0)
                ->select(
                    'a.id_tc_permohonan',
                    'a.id_tc_permohonan_det',
                    'a.kode_brg',
                    'b.nama_brg',
                    'a.jumlah_besar',
                    'a.satuan'
                )
                ->get();

            $detailsGrouped = $details->groupBy('id_tc_permohonan');

            foreach ($prs->items() as $item) {
                $item->items = isset($detailsGrouped[$item->id_tc_permohonan]) ? $detailsGrouped[$item->id_tc_permohonan] : [];
                $item->jml_brg = count($item->items);
            }
        }

        return Inertia::render('Manajemen/AccPurchasing/Index', [
            'prs' => $prs,
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    public function approve(Request $request, $id)
    {
        $pr = DB::table('tc_permohonan_nm')->where('id_tc_permohonan', $id)->first();
        if (! $pr) {
            return back()->withErrors(['error' => 'Permintaan Pembelian tidak ditemukan.']);
        }

        if ($pr->no_acc) {
            return back()->withErrors(['error' => 'Permintaan Pembelian ini sudah disetujui sebelumnya.']);
        }

        try {
            DB::beginTransaction();

            // Generate no_acc from kode_permohonan (replace PPNM with NPPNM)
            $noAcc = str_replace('PPNM', 'NPPNM', $pr->kode_permohonan);

            DB::table('tc_permohonan_nm')
                ->where('id_tc_permohonan', $id)
                ->update([
                    'no_acc' => $noAcc,
                    'tgl_acc' => Carbon::now(),
                    'user_id_acc' => 1, // hardcode for now
                    'status_kirim' => 1,
                ]);

            DB::commit();

            return back()->with('success', 'Permintaan Pembelian berhasil disetujui (No ACC: '.$noAcc.').');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal menyetujui: '.$e->getMessage()]);
        }
    }
}
