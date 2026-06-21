<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PermintaanPembelianController extends Controller
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
            $query->where(function ($q) use ($search) {
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

            // Generate kode_permohonan (e.g. 489/PPNM/06/2026)
            $month = Carbon::now()->format('m');
            $year = Carbon::now()->format('Y');

            $lastPr = DB::table('tc_permohonan_nm')
                ->whereYear('tgl_permohonan', $year)
                ->orderBy('id_tc_permohonan', 'desc')
                ->first();

            $nextNum = 1;
            if ($lastPr && preg_match('/^(\d+)\//', $lastPr->kode_permohonan, $matches)) {
                $nextNum = intval($matches[1]) + 1;
            }

            $kodePermohonan = sprintf('%d/PPNM/%s/%s', $nextNum, $month, $year);

            $idTcPermohonan = DB::table('tc_permohonan_nm')->insertGetId([
                'kode_permohonan' => $kodePermohonan,
                'no_urut_periodik' => $nextNum,
                'tgl_permohonan' => Carbon::now(),
                'user_id' => 1, // hardcode for now
                'jenis_permohonan' => 1,
                'status_batal' => 0,
                'status_kirim' => 1,
                'kodesupplier' => $request->kodesupplier,
                'kode_bagian' => '070201', // Gudang Non Medis
            ]);

            $details = [];
            foreach ($request->items as $item) {
                $details[] = [
                    'id_tc_permohonan' => $idTcPermohonan,
                    'kode_brg' => $item['kode_brg'],
                    'jumlah_besar' => $item['jumlah_besar'],
                    'satuan_besar' => $item['satuan_besar'] ?? '',
                    'rasio' => 1,
                    'status_po' => 0,
                    'status_batal' => 0,
                    'user_id' => 1,
                    'flag_satuan' => 1,
                    'pilih_satuan' => 1,
                    'satuan' => $item['satuan'] ?? '',
                ];
            }

            DB::table('tc_permohonan_nm_det')->insert($details);

            DB::commit();

            return redirect('/gudang/permintaan-pembelian')->with('success', 'Permintaan Pembelian berhasil dibuat dengan Kode: '.$kodePermohonan);

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal menyimpan Permintaan Pembelian: '.$e->getMessage()]);
        }
    }
}
