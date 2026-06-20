<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;

class LaporanKasirController extends Controller
{
    /**
     * Tampilkan halaman Laporan Kasir
     */
    public function index(Request $request)
    {
        // Ambil data user untuk pilihan petugas kasir
        $users = DB::table('dd_user')
            ->select('id_dd_user', 'no_induk', 'nama_lengkap', 'username')
            ->orderBy('nama_lengkap')
            ->get();

        return Inertia::render('Laporan/LaporanKasir', [
            'users' => $users
        ]);
    }

    /**
     * Cetak Laporan
     */
    public function print(Request $request)
    {
        // Parameter bisa dilempar sebagai query string, 
        // lalu kita fetch datanya di backend atau langsung lempar params ke view.
        // Di sini kita fetch di backend agar data konsisten saat di-print
        
        $data = $this->fetchData($request);

        return Inertia::render('Laporan/LaporanKasirPrint', [
            'data' => $data['detail'],
            'rekap' => $data['rekap'],
            'filters' => $request->all(),
            'waktu_cetak' => now()->format('d/m/Y H:i:s'),
            'pencetak' => DB::table('dd_user')->where('id_dd_user', auth()->id() ?? 1)->value('nama_lengkap') ?? 'Sistem'
        ]);
    }

    /**
     * API untuk fetch data Laporan (digunakan oleh Datatables / React State)
     */
    public function getData(Request $request)
    {
        return response()->json($this->fetchData($request));
    }

    /**
     * Logic inti untuk menarik data
     */
    private function fetchData(Request $request)
    {
        $tglAwal = $request->input('tgl_awal', date('Y-m-d'));
        $tglAkhir = $request->input('tgl_akhir', date('Y-m-d'));
        $petugas = $request->input('petugas', 'all');
        $shift = $request->input('shift', 'all');
        $loket = $request->input('loket', 'all');

        $query = DB::table('tc_trans_kasir as t')
            ->leftJoin('mt_master_pasien as p', 't.no_mr', '=', 'p.no_mr')
            ->leftJoin('dd_user as u', 't.no_induk', '=', 'u.id_dd_user')
            ->select(
                't.kode_tc_trans_kasir',
                't.no_registrasi',
                't.tgl_jam',
                't.bill',
                't.tunai',
                't.debet',
                't.kredit',
                't.diskon',
                't.adm_cc',
                't.uang_diterima',
                't.uang_kembali',
                't.status_batal',
                't.kode_shift',
                't.kode_loket',
                'p.nama_pasien',
                'p.no_mr',
                'u.nama_lengkap as nama_petugas'
            )
            ->whereDate('t.tgl_jam', '>=', $tglAwal)
            ->whereDate('t.tgl_jam', '<=', $tglAkhir);

        if ($petugas !== 'all' && !empty($petugas)) {
            $query->where('t.no_induk', $petugas);
        }

        if ($shift !== 'all' && !empty($shift)) {
            $query->where('t.kode_shift', $shift);
        }

        if ($loket !== 'all' && !empty($loket)) {
            $query->where('t.kode_loket', $loket);
        }

        $detail = $query->orderBy('t.tgl_jam', 'desc')->get();

        // Hitung Rekapitulasi
        $rekap = [
            'total_transaksi' => $detail->count(),
            'total_batal' => 0,
            'tunai' => 0,
            'kredit' => 0,
            'debet' => 0,
            'diskon' => 0,
            'adm_cc' => 0,
            'total_bersih' => 0
        ];

        foreach ($detail as $row) {
            // Jika batal, tidak masuk ke rekap pendapatan, tapi dihitung total batalnya
            if ($row->status_batal == 1) {
                $rekap['total_batal']++;
                continue;
            }

            // Jika tidak ada kolom tunai, ambil dari bill
            $tunai = $row->tunai ?? $row->bill ?? 0;
            $kredit = $row->kredit ?? 0;
            $debet = $row->debet ?? 0;
            $diskon = $row->diskon ?? 0;
            $adm = $row->adm_cc ?? 0;

            $rekap['tunai'] += $tunai;
            $rekap['kredit'] += $kredit;
            $rekap['debet'] += $debet;
            $rekap['diskon'] += $diskon;
            $rekap['adm_cc'] += $adm;

            $rekap['total_bersih'] += ($tunai + $kredit + $debet) - $diskon;
        }

        // Mapping Data untuk tampilan
        $mappedDetail = $detail->map(function($item) {
            return [
                'no_transaksi' => $item->kode_tc_trans_kasir,
                'no_registrasi' => $item->no_registrasi,
                'tgl_jam' => Carbon::parse($item->tgl_jam)->format('d/m/Y H:i'),
                'no_mr' => $item->no_mr ?? '-',
                'nama_pasien' => $item->nama_pasien ?? 'UMUM',
                'petugas' => $item->nama_petugas ?? '-',
                'shift' => $item->kode_shift,
                'loket' => $item->kode_loket,
                'total_tagihan' => $item->bill,
                'tunai' => $item->tunai ?? $item->bill,
                'kredit' => $item->kredit,
                'debet' => $item->debet,
                'diskon' => $item->diskon,
                'uang_diterima' => $item->uang_diterima ?? 0,
                'uang_kembali' => $item->uang_kembali ?? 0,
                'status' => $item->status_batal == 1 ? 'Batal' : 'Sukses',
                'status_batal' => $item->status_batal
            ];
        });

        return [
            'rekap' => $rekap,
            'detail' => $mappedDetail
        ];
    }
    /**
     * Export data Laporan ke format CSV
     */
    public function exportCsv(Request $request)
    {
        $data = $this->fetchData($request);
        $detail = $data['detail'];
        
        $tglAwal = $request->input('tgl_awal', date('Y-m-d'));
        $tglAkhir = $request->input('tgl_akhir', date('Y-m-d'));
        $fileName = "Laporan_Kasir_$tglAwal_sd_$tglAkhir.csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['No Transaksi', 'No Registrasi', 'Tanggal', 'No RM', 'Pasien', 'Petugas', 'Shift', 'Loket', 'Total Tagihan', 'Tunai', 'Kredit', 'Debet', 'Diskon', 'Status'];

        $callback = function() use($detail, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($detail as $row) {
                fputcsv($file, [
                    $row['no_transaksi'],
                    $row['no_registrasi'],
                    $row['tgl_jam'],
                    $row['no_mr'],
                    $row['nama_pasien'],
                    $row['petugas'],
                    $row['shift'],
                    $row['loket'],
                    $row['total_tagihan'],
                    $row['tunai'],
                    $row['kredit'],
                    $row['debet'],
                    $row['diskon'],
                    $row['status']
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}