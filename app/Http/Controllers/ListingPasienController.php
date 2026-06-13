<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ListingPasienController extends Controller
{
    public function listingPoli(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('listing_pasien_registasi_v')
            ->whereIn('no_registrasi', function ($q) {
                $q->select('no_registrasi')->from('tc_registrasi')->whereNull('status_batal');
            });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('no_mr', 'like', "%{$search}%")
                  ->orWhere('nama_pasien', 'like', "%{$search}%")
                  ->orWhere('nama_poli', 'like', "%{$search}%")
                  ->orWhere('nama_dokter', 'like', "%{$search}%")
                  ->orWhere('noSep', 'like', "%{$search}%")
                  ->orWhere('noKartuPeserta', 'like', "%{$search}%");
            });
        }

        $pasien = $query->orderBy('tgl_jam_poli', 'desc')
                        ->orderBy('nama_poli', 'asc')
                        ->paginate(20)
                        ->through(function ($item) {
                            $nasabah = 'Umum';
                            if (in_array($item->kode_kelompok, [3, 5, 8, 9, 11])) {
                                if ($item->kode_perusahaan) {
                                    $perusahaan = DB::table('mt_perusahaan')->where('kode_perusahaan', $item->kode_perusahaan)->first();
                                    $nasabah = $perusahaan ? $perusahaan->nama_perusahaan : '';
                                }
                                if (empty($nasabah)) {
                                    $kelompok = DB::table('mt_nasabah')->where('kode_kelompok', $item->kode_kelompok)->first();
                                    $nasabah = $kelompok ? $kelompok->nama_kelompok : '';
                                }
                            }

                            // Fetch catatan khusus
                            $catatan = DB::table('th_catatan_khusus_pasien')
                                ->where('no_mr', $item->no_mr)
                                ->orderBy('id_catatan_khusus', 'desc')
                                ->value('catatan');

                            return [
                                'no_registrasi' => $item->no_registrasi,
                                'no_mr' => $item->no_mr,
                                'tanggal' => $item->tgl_jam_poli,
                                'nama_pasien' => $item->nama_pasien,
                                'nama_keluarga' => $item->nama_kel_pasien,
                                'nasabah' => $nasabah,
                                'ruangan' => $item->nama_poli,
                                'dokter' => $item->nama_dokter,
                                'catatan_khusus' => $catatan,
                                'noSep' => $item->noSep,
                                'noKartuPeserta' => $item->noKartuPeserta,
                            ];
                        });

        return Inertia::render('Registrasi/ListingPoli', [
            'data' => $pasien,
            'filters' => ['search' => $search]
        ]);
    }

    public function permintaanRi(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('tc_permintaan_ri_v')
                   ->whereNotNull('tgl_update');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('no_mr', 'like', "%{$search}%")
                  ->orWhere('nama_pasien', 'like', "%{$search}%");
            });
        }

        $permintaan = $query->orderBy('tgl_update', 'desc')
                            ->paginate(20)
                            ->through(function ($item) {
                                // In the legacy code, nama_dokter is fetched from mt_karyawan where kode_dokter
                                $nama_dokter = '';
                                if ($item->kode_dokter) {
                                    $dokter = DB::table('mt_karyawan')->where('kode_dokter', $item->kode_dokter)->first();
                                    $nama_dokter = $dokter ? $dokter->nama_pegawai : '';
                                }

                                // Nasabah from tc_registrasi
                                $nasabah = '';
                                $registrasi = DB::table('tc_registrasi')->where('no_registrasi', $item->no_registrasi)->first();
                                if ($registrasi) {
                                    if ($registrasi->kode_perusahaan) {
                                        $perusahaan = DB::table('mt_perusahaan')->where('kode_perusahaan', $registrasi->kode_perusahaan)->first();
                                        $nasabah = $perusahaan ? $perusahaan->nama_perusahaan : '';
                                    } else {
                                        $kel = DB::table('mt_nasabah')->where('kode_kelompok', $registrasi->kode_kelompok)->first();
                                        $nasabah = $kel ? $kel->nama_kelompok : '';
                                    }
                                }

                                return [
                                    'no_registrasi' => $item->no_registrasi,
                                    'no_mr' => $item->no_mr,
                                    'nama_pasien' => $item->nama_pasien,
                                    'nasabah' => $nasabah,
                                    'dirujuk_dari' => $item->nama_bagian,
                                    'tgl_permintaan' => $item->tgl_update,
                                    // In legacy code it shows `nama_bagian` twice but one of them was $bagian. 
                                    // Actually `$bagian = $tampil["nama_bagian"];` and `$nama_bagian=baca_tabel("mt_bagian","nama_bagian","WHERE kode_bagian=$rujukan_dari");`
                                    // But $item->nama_bagian is likely the `bagian`. Let's just use it for "dirujuk dari" as they both mean the same in this context or we can look up rujukan_dari if it's not available in view.
                                    // Actually tc_permintaan_ri_v doesn't return rujukan_dari in the dump. So let's use nama_bagian.
                                    'nama_bagian' => $item->nama_bagian,
                                    'nama_dokter' => $nama_dokter,
                                ];
                            });

        return Inertia::render('Registrasi/PermintaanRi', [
            'data' => $permintaan,
            'filters' => ['search' => $search]
        ]);
    }
}
