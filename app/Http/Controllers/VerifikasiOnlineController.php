<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class VerifikasiOnlineController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'baru'); // 'baru', 'verifikasi', 'reject'
        $search = $request->query('search', '');
        $topic = $request->query('topic', 'nama'); // 'mr', 'nama', 'nasabah', 'alamat', 'ktp', 'telpon'

        $query = DB::table('rg_master_pasien_ol_v');

        if ($tab === 'baru') {
            $query->whereNull('no_mr_int')->whereNull('status_batal');
        } elseif ($tab === 'verifikasi') {
            $query->whereNotNull('no_mr_int')->whereNull('status_batal');
        } elseif ($tab === 'reject') {
            $query->where('status_batal', 1);
        }

        if (! empty($search)) {
            switch ($topic) {
                case 'nama':
                    $query->where('nama_pasien', 'LIKE', '%'.$search.'%');
                    break;
                case 'mr':
                    $query->where('no_mr', $search);
                    break;
                case 'nasabah':
                    $query->where(function ($q) use ($search) {
                        $q->where('nasabah', 'LIKE', '%'.$search.'%')
                            ->orWhere('perusahaan', 'LIKE', '%'.$search.'%');
                    });
                    break;
                case 'alamat':
                    $query->where('almt_ttp_pasien', 'LIKE', '%'.$search.'%');
                    break;
                case 'ktp':
                    $query->where('no_ktp', 'LIKE', '%'.$search.'%');
                    break;
                case 'telpon':
                    $query->where('tlp_almt_ttp', 'LIKE', '%'.$search.'%');
                    break;
            }
        }

        $pasien = $query->orderBy('no_mr')->paginate(20)->withQueryString();

        return Inertia::render('Registrasi/ListingOnline', [
            'dataPasien' => $pasien,
            'filters' => [
                'tab' => $tab,
                'search' => $search,
                'topic' => $topic,
            ],
        ]);
    }
}
