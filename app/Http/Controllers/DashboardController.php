<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function show($modul)
    {
        $id_dd_user = Session::get('id_dd_user');
        Log::info('DashboardController show: id_dd_user='.$id_dd_user.' modul='.$modul);

        // Fetch Module Info
        $module = DB::table('dc_modul')->where('id_dc_modul', $modul)->first();
        $moduleName = $module ? $module->nama_modul : 'Dashboard';

        // Fetch User Privileges for this Module from admin_hak_user_v
        $hakAkses = DB::table('admin_hak_user_v')
            ->select(
                'id_dc_menu',
                'nama_menu',
                'no_urut_menu',
                'id_dc_sub_menu',
                'nama_sub_menu',
                'url_sub_menu',
                'no_urut_sub_menu'
            )
            ->where('id_dd_user', $id_dd_user)
            ->where('id_dc_modul', $modul)
            ->distinct()
            ->orderBy('no_urut_menu')
            ->orderBy('no_urut_sub_menu')
            ->get();

        $menus = [];

        foreach ($hakAkses as $row) {
            // Check if menu already exists in array
            if (! isset($menus[$row->id_dc_menu])) {
                $menus[$row->id_dc_menu] = [
                    'id_dc_menu' => $row->id_dc_menu,
                    'nama_menu' => $row->nama_menu,
                    'sub_menus' => [],
                ];
            }

            // Append sub menu if exists
            if ($row->id_dc_sub_menu) {
                // Ensure sub menu is not duplicated
                $subExists = false;
                foreach ($menus[$row->id_dc_menu]['sub_menus'] as $sub) {
                    if ($sub['id_dc_sub_menu'] == $row->id_dc_sub_menu) {
                        $subExists = true;
                        break;
                    }
                }

                if (! $subExists) {
                    $menus[$row->id_dc_menu]['sub_menus'][] = [
                        'id_dc_sub_menu' => $row->id_dc_sub_menu,
                        'nama_sub_menu' => $row->nama_sub_menu,
                        'url_sub_menu' => $row->url_sub_menu,
                    ];
                }
            }
        }

        // Convert menus to sequential array
        $menus = array_values($menus);

        Log::info('Menus for User '.$id_dd_user.' Modul '.$modul.': '.json_encode($menus));

        return inertia('Dashboard', [
            'module_name' => $moduleName,
            'menus' => $menus,
        ]);
    }
}
