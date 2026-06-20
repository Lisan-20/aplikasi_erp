<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ConsentController extends Controller
{
    public function generalConsent(Request $request)
    {
        $no_mr = $request->query('no_mr');
        $type  = $request->query('type', 'umum');

        $pasien = null;
        if ($no_mr) {
            $pasien = DB::table('mt_master_pasien')->where('no_mr', $no_mr)->first();
        }

        return Inertia::render('Poli/GeneralConsent', [
            'type'         => $type,
            'pasien'       => $pasien,
            'current_date' => date('Y-m-d H:i:s'),
        ]);
    }

    public function show($type, $no_mr)
    {
        $pasien = DB::table('mt_master_pasien')->where('no_mr', $no_mr)->first();

        if (!$pasien) {
            abort(404, 'Pasien tidak ditemukan');
        }

        return Inertia::render('Poli/GeneralConsent', [
            'type' => $type,
            'pasien' => $pasien,
            'current_date' => date('Y-m-d H:i:s'),
        ]);
    }
}
