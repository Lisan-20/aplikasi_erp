<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PoliController extends Controller
{
    public function antrianPoli(Request $request)
    {
        $search = $request->input('search');
        $kode_bagian = $request->input('kode_bagian');
        $topik = $request->input('topik', 'no_mr');

        $query = DB::table('pl_mt_pasien_v')
            ->where(function ($q) {
                $q->where('status_periksa', 0)
                    ->orWhereNull('status_periksa');
            })
            ->where('no_antrian', '>', 0)
            ->where('kode_bagian', '<>', '011801')
            ->whereNull('status_blpl')
            ->where('daftar_ol', 2)
            ->whereNull('status_bayar');

        if ($kode_bagian && $kode_bagian !== 'semua') {
            $query->where('kode_bagian_poli', $kode_bagian);
        } else {
            $query->whereNotNull('kode_bagian_poli');
            $query->where('kode_bagian_poli', '<>', '');
        }

        if ($search) {
            switch ($topik) {
                case 'nama_pasien':
                    $query->where('nama_pasien', 'like', "%{$search}%");
                    break;
                case 'no_mr':
                    $query->where('no_mr', $search);
                    break;
                case 'kode_dokter':
                    $query->where('nama_dokter', 'like', "%{$search}%");
                    break;
                case 'nasabah':
                    $query->where('nasabah', 'like', "%{$search}%");
                    break;
            }
        } else {
            // Default 30 days filter if no specific search
            $dateLimit = Carbon::now()->subDays(30)->toDateString();
            $query->whereDate('tgl_jam_poli', '>=', $dateLimit);
        }

        $antrian = $query->orderBy('kode_bagian_poli', 'asc')
            ->orderBy('nama_poli', 'asc')
            ->orderBy('tgl_jam_poli', 'desc')
            ->orderBy('nama_dokter', 'asc')
            ->orderBy('nama_pasien', 'asc')
            ->orderBy('no_antrian', 'asc')
            ->paginate(20)
            ->through(function ($item) {
                $nasabah = '';
                if ($item->kode_kelompok == 5 || $item->kode_kelompok == 3 || $item->kode_kelompok == 11) {
                    if ($item->kode_perusahaan) {
                        $perusahaan = DB::table('mt_perusahaan')->where('kode_perusahaan', $item->kode_perusahaan)->first();
                        $nasabah = $perusahaan ? $perusahaan->nama_perusahaan : '';
                    }
                } else {
                    $kelompok = DB::table('mt_nasabah')->where('kode_kelompok', $item->kode_kelompok)->first();
                    $nasabah = $kelompok ? $kelompok->nama_kelompok : '';
                }

                $penanggung = '';
                if ($item->kode_penanggung > 0) {
                    $perusahaan = DB::table('mt_perusahaan')->where('kode_perusahaan', $item->kode_penanggung)->first();
                    $penanggung = $perusahaan ? $perusahaan->nama_perusahaan : '';
                }

                $catatan = DB::table('th_catatan_khusus_pasien')
                    ->where('no_mr', $item->no_mr)
                    ->orderBy('id_catatan_khusus', 'desc')
                    ->value('catatan');

                $jadwal = DB::table('jadwal_dokter')
                    ->where('kode_jadwal', $item->kode_jadwal)
                    ->value('jadwal_dokter');

                return [
                    'no_mr' => $item->no_mr,
                    'no_registrasi' => $item->no_registrasi,
                    'no_kunjungan' => $item->no_kunjungan,
                    'nama_pasien' => $item->nama_pasien,
                    'status_pasien' => $item->stat_pasien,
                    'nasabah' => $nasabah.($penanggung ? ' / '.$penanggung : ''),
                    'nama_poli' => $item->nama_poli,
                    'nama_dokter' => $item->nama_dokter,
                    'no_antrian' => $item->kode_bagian_poli != '011901' ? $item->no_antrian : '',
                    'jadwal_praktek' => $jadwal,
                    'tgl_jam_poli' => $item->tgl_jam_poli,
                    'catatan_khusus' => $catatan,
                ];
            });

        // Get Poliklinik list for dropdown
        $poliklinik = DB::table('mt_bagian')
            ->where('kode_bagian', 'like', '01%')
            ->where('group_bag', '<>', 'Group')
            ->where('status_aktif', 1)
            ->where('kode_bagian', '<>', '011801')
            ->orderBy('nama_bagian', 'asc')
            ->get(['kode_bagian', 'nama_bagian']);

        return Inertia::render('Poli/AntrianPoli', [
            'data' => $antrian,
            'poliklinik' => $poliklinik,
            'filters' => [
                'search' => $search,
                'kode_bagian' => $kode_bagian,
                'topik' => $topik,
            ],
        ]);
    }
}
