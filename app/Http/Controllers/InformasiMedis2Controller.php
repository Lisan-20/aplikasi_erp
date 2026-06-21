<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InformasiMedis2Controller extends Controller
{
    /**
     * Legacy: mod_registrasi/info_ruangan.php
     */
    public function infoRuangan(Request $request)
    {
        $query = DB::table('rg_inforuang_v');

        $search = $request->input('filter');
        $tipeCari = $request->input('tipeCari', 'nama');

        if ($search) {
            switch ($tipeCari) {
                case 'nama':
                    $query->where('nama_bagian', 'LIKE', "%{$search}%");
                    break;
                case 'klas':
                    $query->where('nama_klas', 'LIKE', "%{$search}%");
                    break;
                case 'kamar':
                    $query->where('no_kamar', $search);
                    break;
                case 'status':
                    $query->where('status', 'LIKE', "%{$search}%");
                    break;
            }
        }

        $query->orderBy('kode_bagian')->orderBy('kode_klas');

        $data = $query->paginate(20)->withQueryString();

        return Inertia::render('Registrasi/InfoRuangan', [
            'data' => $data,
            'filters' => [
                'filter' => $search,
                'tipeCari' => $tipeCari,
            ],
        ]);
    }

    /**
     * Legacy: mod_registrasi/info_ruangan2.php
     */
    public function infoRuangan2(Request $request)
    {
        $query = DB::table('mt_ruangan')
            ->whereNotNull('kode_bagian')
            ->where('kode_bagian', '<>', '')
            ->where('kode_bagian', '<>', '030701')
            ->orderBy('no_kamar')
            ->orderBy('no_bed');

        $search = $request->input('filter');
        $tipeCari = $request->input('tipeCari', 'nama');

        // Apply search using some basic joins or direct conditions
        if ($search) {
            if ($tipeCari == 'nama') {
                // To filter by nama we might need to join mt_bagian, but legacy info_ruangan2
                // disabled search. Let's try to map what we can.
                // Assuming `mt_bagian` table exists.
                $query->whereIn('kode_bagian', function ($q) use ($search) {
                    $q->select('kode_bagian')
                        ->from('mt_bagian')
                        ->where('nama_bagian', 'LIKE', "%{$search}%");
                });
            } elseif ($tipeCari == 'klas') {
                $query->whereIn('kode_klas', function ($q) use ($search) {
                    $q->select('kode_klas')
                        ->from('mt_klas')
                        ->where('nama_klas', 'LIKE', "%{$search}%");
                });
            } elseif ($tipeCari == 'kamar') {
                $query->where('no_kamar', $search);
            } elseif ($tipeCari == 'status') {
                $query->where('status', 'LIKE', "%{$search}%");
            }
        }

        $paginated = $query->paginate(20)->withQueryString();

        // Loop over the items and append the necessary joined data manually to exactly mirror legacy
        $items = collect($paginated->items())->map(function ($item) {
            $klas = DB::table('mt_klas')->where('kode_klas', $item->kode_klas)->first();
            $item->nama_klas = $klas ? $klas->nama_klas : '';

            if ($item->status == 'ISI') {
                $pasien = DB::table('ri_cari_pasien_v')->where('kode_ruangan', $item->kode_ruangan)->first();
                if ($pasien) {
                    $item->tgl_masuk = $pasien->tgl_masuk ?? null;
                    $item->no_mr = $pasien->no_mr ?? null;
                    $item->nama_pasien = $pasien->nama_pasien ?? null;

                    $kode_kelompok = $pasien->kode_kelompok ?? null;
                    $penjamin = DB::table('mt_nasabah')->where('kode_kelompok', $kode_kelompok)->first();
                    $item->nama_kelompok = $penjamin ? $penjamin->nama_kelompok : '';

                    if ($kode_kelompok != 12 && $kode_kelompok != 9) {
                        $perusahaan = DB::table('mt_perusahaan')->where('kode_perusahaan', $pasien->kode_perusahaan ?? null)->first();
                        $item->nama_perusahaan = $perusahaan ? $perusahaan->nama_perusahaan : '';
                    } else {
                        $item->nama_perusahaan = '';
                    }
                } else {
                    $item->tgl_masuk = null;
                    $item->no_mr = null;
                    $item->nama_pasien = null;
                    $item->nama_kelompok = null;
                    $item->nama_perusahaan = null;
                }
            } else {
                $item->tgl_masuk = null;
                $item->no_mr = null;
                $item->nama_pasien = null;
                $item->nama_kelompok = null;
                $item->nama_perusahaan = null;
            }

            return $item;
        });

        // Replace paginated items
        $data = new LengthAwarePaginator(
            $items,
            $paginated->total(),
            $paginated->perPage(),
            $paginated->currentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );

        return Inertia::render('Registrasi/InfoRuangan2', [
            'data' => $data,
            'filters' => [
                'filter' => $search,
                'tipeCari' => $tipeCari,
            ],
        ]);
    }

    /**
     * Legacy: mod_registrasi/ruangan.php
     */
    public function hargaKamar(Request $request)
    {
        $query = DB::table('admin_tarifruang_v');

        $search = $request->input('filter');
        $tipeCari = $request->input('tipeCari', 'nama');

        if ($search) {
            switch ($tipeCari) {
                case 'nama':
                    $query->where('nama_bagian', 'LIKE', "%{$search}%");
                    break;
                case 'klas':
                    $query->where('nama_klas', 'LIKE', "%{$search}%");
                    break;
                case 'kode_ruangan':
                    $query->where('kode_ruangan', 'LIKE', "{$search}%");
                    break;
            }
        }

        $data = $query->paginate(20)->withQueryString();

        return Inertia::render('Registrasi/HargaKamar', [
            'data' => $data,
            'filters' => [
                'filter' => $search,
                'tipeCari' => $tipeCari,
            ],
        ]);
    }
}
