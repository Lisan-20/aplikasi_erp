<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ModuleController extends Controller
{
    public function index()
    {
        $userId = Session::get('id_dd_user');

        $modules = DB::table('admin_hak_user_v as hak')
            ->join('dc_modul as m', 'hak.id_dc_modul', '=', 'm.id_dc_modul')
            ->join('dc_modular as mr', 'm.id_dc_modular', '=', 'mr.id_dc_modular')
            ->where('hak.id_dd_user', $userId)
            ->orderBy('hak.no_urut_modular', 'asc')
            ->orderBy('hak.no_urut_modul', 'asc')
            ->select(
                'mr.id_dc_modular',
                'mr.nama_modular',
                'hak.no_urut_modular',
                'm.id_dc_modul',
                'm.nama_modul',
                'hak.no_urut_modul'
            )
            ->distinct()
            ->get();

        // Grouping by dc_modular
        $groupedData = $modules->groupBy('id_dc_modular')->map(function ($group) {
            return [
                'id_dc_modular' => $group->first()->id_dc_modular,
                'nama_modular' => $group->first()->nama_modular,
                'modules' => $group->map(function ($item) {
                    return [
                        'id_dc_modul' => $item->id_dc_modul,
                        'nama_modul' => $item->nama_modul,
                    ];
                })->values()->all(),
            ];
        })->values()->all();

        return inertia('ModuleSelection', [
            'modulars' => $groupedData,
        ]);
    }

    public function enterModule(Request $request, $id_modul)
    {
        $userId = Session::get('id_dd_user');
        $idLogUser = Session::get('id_log_user');

        $hakUser = DB::table('admin_hak_user_v')
            ->where('id_dd_user', $userId)
            ->where('id_dc_modul', $id_modul)
            ->first();

        if (! $hakUser) {
            abort(403, 'Unauthorized access to this module.');
        }

        if ($idLogUser) {
            DB::table('log_user_login_detail')->insert([
                'id_log_user' => $idLogUser,
                'login_time_detail' => now(),
                'id_dc_modul' => $id_modul,
            ]);
        }

        Session::put('active_modul', $id_modul);

        return redirect()->route('dashboard', ['modul' => $id_modul]);
    }
}
