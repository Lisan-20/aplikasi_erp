<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InformasiMedis3Controller extends Controller
{
    public function infoTarifUmum(Request $request)
    {
        $query = DB::table('admin_mt_tarif_view');

        if ($request->filled('filter') && $request->filled('typeCari')) {
            if ($request->typeCari == '1') {
                $query->where('kode_tindakan', 'like', $request->filter.'%');
            } elseif ($request->typeCari == '2') {
                $query->where('nama_tarif', 'like', '%'.$request->filter.'%');
            }
        }

        $data = $query->paginate(20)->withQueryString();

        return Inertia::render('InformasiMedis3/InfoTarifUmum', [
            'data' => $data,
            'filters' => $request->only(['filter', 'typeCari']),
        ]);
    }

    public function paketBedah(Request $request)
    {
        $query = DB::table('mt_tarif_bedah_ok_v');

        if ($request->filled('filter') && $request->filled('tipeCari')) {
            if ($request->tipeCari == 'nama_operasi') {
                $query->where('nama_operasi', 'like', '%'.$request->filter.'%');
            } elseif ($request->tipeCari == 'bagian') {
                $query->where('bagian', 'like', '%'.$request->filter.'%');
            }
        }

        $data = $query->orderBy('kode_tarif')->paginate(20)->withQueryString();

        return Inertia::render('InformasiMedis3/PaketBedah', [
            'data' => $data,
            'filters' => $request->only(['filter', 'tipeCari']),
        ]);
    }

    public function paketMelahirkan(Request $request)
    {
        // Legacy file has static output, we emulate that
        $data = [
            'data' => [
                [
                    'id' => 1,
                    'jenis_paket' => 'Kelahiran Normal',
                    'tindakan' => 'Infus',
                    'klas' => 'Klas III',
                    'bill_dr1' => 150000,
                    'bill_dr2' => 150000,
                    'bill_rs' => 150000,
                    'total' => 450000,
                ],
                [
                    'id' => 2,
                    'jenis_paket' => 'Kelahiran Lewat Operasi',
                    'tindakan' => 'Infus',
                    'klas' => 'Suite Room',
                    'bill_dr1' => 150000,
                    'bill_dr2' => 150000,
                    'bill_rs' => 150000,
                    'total' => 450000,
                ],
            ],
            'links' => [],
        ];

        return Inertia::render('InformasiMedis3/PaketMelahirkan', [
            'data' => $data,
            'filters' => $request->only(['filter', 'tipeCari']),
        ]);
    }
}
