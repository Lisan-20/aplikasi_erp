<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InformasiMedis1Controller extends Controller
{
    public function jadwalDokter(Request $request)
    {
        $query = DB::table('v_jadwal_dokter');

        if ($request->filled('filter') && $request->filled('tipeCari')) {
            $filter = $request->filter;
            switch ($request->tipeCari) {
                case 'nama':
                    $query->where('nama_pegawai', 'like', "%{$filter}%");
                    break;
                case 'bagian':
                    $query->where('nama_bagian', 'like', "%{$filter}%");
                    break;
                case 'spesialis':
                    $query->where('nama_spesialisasi', 'like', "%{$filter}%");
                    break;
                case 'hari':
                    $query->where('range_hari', 'like', "%{$filter}%");
                    break;
            }
        }

        $jadwal = $query->orderBy('kode_dokter')->paginate(20)->withQueryString();

        return Inertia::render('Registrasi/JadwalDokter', [
            'jadwal' => $jadwal,
            'filters' => $request->only(['filter', 'tipeCari']),
        ]);
    }

    public function riwayatPasien(Request $request)
    {
        $query = DB::table('rg_master_pasien_v');

        if ($request->filled('topik') && $request->filled('filter')) {
            $filter = $request->filter;
            switch ($request->topik) {
                case 'nama':
                    $query->where('nama_pasien', 'like', "%{$filter}%");
                    break;
                case 'mr':
                    $query->where('no_mr', $filter);
                    break;
                case 'nasabah':
                    $query->where(function ($q) use ($filter) {
                        $q->where('nasabah', 'like', "%{$filter}%")
                            ->orWhere('perusahaan', 'like', "%{$filter}%");
                    });
                    break;
                case 'alamat':
                    $query->where('almt_ttp_pasien', 'like', "%{$filter}%");
                    break;
                case 'tgl_lahir':
                    $query->where('tgl_lhr', 'like', "%{$filter}%");
                    break;
                case 'ktp':
                    $query->where('no_ktp', 'like', "%{$filter}%");
                    break;
                case 'telpon':
                    $query->where('tlp_almt_ttp', 'like', "%{$filter}%");
                    break;
            }
        } else {
            $query->whereNull('id_mt_master_pasien');
        }

        $pasien = $query->orderBy('no_mr')->paginate(20)->withQueryString();

        return Inertia::render('Registrasi/RiwayatPasien', [
            'pasien' => $pasien,
            'filters' => $request->only(['filter', 'topik']),
        ]);
    }
}
