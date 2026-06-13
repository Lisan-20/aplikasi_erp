<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PasienLamaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('mt_master_pasien')
            ->select(
                'no_mr',
                'nama_pasien',
                'no_ktp',
                'jen_kelamin',
                'tgl_lhr',
                'almt_ttp_pasien',
                'tlp_almt_ttp'
            );

        if ($search) {
            $query->where('no_mr', 'like', "%{$search}%")
                  ->orWhere('nama_pasien', 'like', "%{$search}%");
        }

        $patients = $query->orderBy('no_mr', 'desc')->paginate(10)->withQueryString();

        return Inertia::render('Registrasi/PasienLama', [
            'patients' => $patients,
            'filters' => $request->only('search')
        ]);
    }
}
