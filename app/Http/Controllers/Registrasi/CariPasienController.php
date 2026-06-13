<?php

namespace App\Http\Controllers\Registrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CariPasienController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type', 'poli');
        $topik = $request->input('topik', 'nama');
        $filter = $request->input('filter', '');

        $query = DB::table('rg_master_pasien_v');

        if (!empty($filter)) {
            switch ($topik) {
                case 'txt_nik':
                    $query->where('nik', $filter);
                    break;
                case 'nama_ibu':
                    $query->where('nama_ibu', 'like', '%' . $filter . '%');
                    break;
                case 'nama':
                    $query->where('nama_pasien', 'like', '%' . $filter . '%');
                    break;
                case 'mr':
                    $query->where('no_mr', 'like', '%' . $filter . '%');
                    break;
                case 'nasabah':
                    $query->where(function($q) use ($filter) {
                        $q->where('nasabah', 'like', '%' . $filter . '%')
                          ->orWhere('perusahaan', 'like', '%' . $filter . '%')
                          ->orWhere('kode_p', 'like', $filter . '%');
                    });
                    break;
                case 'alamat':
                    $query->where('almt_ttp_pasien', 'like', '%' . $filter . '%');
                    break;
                case 'ktp':
                    $query->where('no_ktp', 'like', '%' . $filter . '%');
                    break;
                case 'telpon':
                    $query->where(function($q) use ($filter) {
                        $q->where('tlp_almt_ttp', 'like', '%' . $filter . '%')
                          ->orWhere('tlp_almt_lkl', 'like', '%' . $filter . '%')
                          ->orWhere('tlp_almt_ttp1', 'like', '%' . $filter . '%');
                    });
                    break;
                case 'nama_kel':
                    $query->where('nama_kel_pasien', 'like', '%' . $filter . '%');
                    break;
                case 'tgl_lahir':
                    $query->whereDate('tgl_lhr', $filter);
                    break;
                default:
                    $query->whereNull('id_mt_master_pasien');
                    break;
            }
        } else {
            // Default condition if no filter is provided (so it doesn't load everything)
            $query->whereNull('id_mt_master_pasien');
        }

        // Add additional specific fields for UI display that aren't purely from rg_master_pasien_v if necessary
        // In the legacy script, nama_kelompok is fetched via baca_tabel but we can just use groups
        // or join if needed. For now we will keep it simple.
        
        $pasien = $query->orderBy('nama_pasien')->paginate(20)->withQueryString();

        return Inertia::render('Registrasi/DaftarCariPasien', [
            'pasien' => $pasien,
            'filters' => [
                'type' => $type,
                'topik' => $topik,
                'filter' => $filter
            ]
        ]);
    }
}
