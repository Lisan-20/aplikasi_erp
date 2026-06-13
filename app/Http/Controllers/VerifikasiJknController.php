<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class VerifikasiJknController extends Controller
{
    public function index()
    {
        return Inertia::render('Registrasi/ListingJkn');
    }

    public function data(Request $request)
    {
        $tab = $request->input('tab', 'baru'); // baru, terverifikasi, reject
        $search = $request->input('search');
        $filterBy = $request->input('filterBy');

        $query = DB::table('pasien_jkn_v');

        if ($tab === 'baru') {
            $query->whereNull('no_mr_int');
        } elseif ($tab === 'terverifikasi') {
            $query->whereNotNull('no_mr_int');
        } elseif ($tab === 'reject') {
            // Note: status_batal condition from legacy comment
            // As fallback we will use where('status_batal', 1) assuming it exists
            $query->where('status_batal', 1);
        }

        if ($search) {
            switch ($filterBy) {
                case 'nama':
                    $query->where('nama_pasien', 'like', '%' . $search . '%');
                    break;
                case 'mr':
                    $query->where('no_mr', $search);
                    break;
                case 'nomorkartu':
                    $query->where('nomorkartu', $search);
                    break;
                case 'nasabah':
                    $query->where(function ($q) use ($search) {
                        $q->where('nasabah', 'like', '%' . $search . '%')
                          ->orWhere('perusahaan', 'like', '%' . $search . '%');
                    });
                    break;
                case 'alamat':
                    $query->where('almt_ttp_pasien', 'like', '%' . $search . '%');
                    break;
                case 'tgl_lahir':
                    $query->where('tgl_lhr', 'like', '%' . $search . '%');
                    break;
                case 'ktp':
                    $query->where('ktp', 'like', '%' . $search . '%');
                    break;
                case 'telpon':
                    $query->where('notlp', 'like', '%' . $search . '%');
                    break;
                default:
                    // do nothing
                    break;
            }
        }

        $data = $query->orderBy('no_mr_int')->paginate(20);

        return response()->json($data);
    }
}
