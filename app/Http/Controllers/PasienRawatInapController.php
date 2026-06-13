<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;

class PasienRawatInapController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $searchBy = $request->input('search_by', 'nama');

        $query = DB::table('ri_cari_pasien_v');

        // Note: the legacy code has some filtering based on session (bag_pas not in (030901,030501,032001) etc.)
        // We will stick to a simpler default to show patients that are currently rawat inap, 
        // matching the main logic: WHERE bag_pas not in (030901,030501,032001)
        // You can adjust these rules as per the new authorization logic.
        $query->whereNotIn('bag_pas', ['030901', '030501', '032001']);

        if ($search) {
            switch ($searchBy) {
                case 'nama':
                    $query->where('nama_pasien', 'like', "%{$search}%");
                    break;
                case 'no_registrasi':
                    $query->where('no_registrasi', 'like', "%{$search}%");
                    break;
                case 'mr':
                    $query->where('no_mr', $search);
                    break;
                case 'kode_bagian':
                    $query->where('nama_bagian', 'like', "%{$search}%");
                    break;
                case 'alamat':
                    $query->where('almt_ttp_pasien', 'like', "%{$search}%");
                    break;
                case 'nasabah':
                    $query->where('nama_kelompok', 'like', "%{$search}%");
                    break;
            }
        }

        $pasien = $query->orderBy('tgl_masuk', 'desc')
            ->paginate(20)
            ->through(function ($item) {
                // Nasabah
                $nasabah = 'Umum';
                if (is_numeric($item->kode_kelompok) && $item->kode_kelompok != 3) {
                    if ($item->kode_kelompok == 5) {
                        $perusahaan = DB::table('mt_perusahaan')->where('kode_perusahaan', $item->kode_perusahaan)->first();
                        $nasabah = $perusahaan ? $perusahaan->nama_perusahaan : '';
                    } else {
                        $kelompok = DB::table('mt_nasabah')->where('kode_kelompok', $item->kode_kelompok)->first();
                        $nasabah = $kelompok ? $kelompok->nama_kelompok : '';
                    }
                } else if ($item->kode_kelompok == 3) {
                    if (is_numeric($item->kode_perusahaan)) {
                        $perusahaan = DB::table('mt_perusahaan')->where('kode_perusahaan', $item->kode_perusahaan)->first();
                        $nasabah = $perusahaan ? $perusahaan->nama_perusahaan : '';
                    } else {
                        $kelompok = DB::table('mt_nasabah')->where('kode_kelompok', $item->kode_kelompok)->first();
                        $nasabah = $kelompok ? $kelompok->nama_kelompok : '';
                    }
                }

                // DPJP (dr_merawat)
                $dokter = '';
                if ($item->dr_merawat) {
                    $karyawan = DB::table('mt_karyawan')->where('kode_dokter', trim($item->dr_merawat))->first();
                    $dokter = $karyawan ? $karyawan->nama_pegawai : '';
                }

                // Kamar / Bed
                $kamar = '';
                $bed = '';
                if ($item->kode_ruangan) {
                    $ruangan = DB::table('mt_ruangan')->where('kode_ruangan', $item->kode_ruangan)->first();
                    if ($ruangan) {
                        $kamar = $ruangan->no_kamar;
                        $bed = $ruangan->no_bed;
                    }
                }

                // Cek Batal
                $cek_batal = DB::table('tc_trans_pelayanan')
                    ->where('no_registrasi', $item->no_registrasi)
                    ->where('jenis_tindakan', '<>', 1)
                    ->where('kode_bagian_asal', 'not like', '02%')
                    ->where('kode_bagian_asal', 'not like', '01%')
                    ->whereNull('status_batal')
                    ->count();

                // Catatan Khusus
                $catatan_khusus = DB::table('th_catatan_khusus_pasien')
                    ->where('no_mr', $item->no_mr)
                    ->orderBy('id_catatan_khusus', 'desc')
                    ->value('catatan');

                return [
                    'no_mr' => $item->no_mr,
                    'no_registrasi' => $item->no_registrasi,
                    'no_kunjungan' => $item->no_kunjungan,
                    'noSep' => $item->noSep,
                    'nama_pasien' => $item->nama_pasien,
                    'alamat' => $item->alamat,
                    'nasabah' => $nasabah,
                    'ruangan' => $item->nama_bagian ?? $item->bag_pas, // or query mt_bagian if needed
                    'kelas' => $item->nama_klas ?? $item->kelas_pas, // or query mt_klas
                    'kamar' => $kamar,
                    'bed' => $bed,
                    'tgl_masuk' => $item->tgl_masuk,
                    'diagnosa_awal' => $item->diagnosa_awal,
                    'dpjp' => $dokter,
                    'can_batal' => $cek_batal == 0,
                    'catatan_khusus' => $catatan_khusus,
                    'ttd_sk_pasien' => $item->ttd_sk_pasien,
                    'ttd_ri' => $item->ttd_ri,
                ];
            });

        return Inertia::render('Registrasi/PasienRawatInap', [
            'data' => $pasien,
            'filters' => [
                'search' => $search,
                'search_by' => $searchBy,
            ]
        ]);
    }
}
