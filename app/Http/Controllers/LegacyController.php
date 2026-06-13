<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LegacyController extends Controller
{
    public function show(Request $request, $legacy_dir, $legacy_file)
    {
        $id_dd_user = Session::get('id_dd_user');
        
        // Find the active module id from the session log or assume Registrasi (2) if unknown,
        // but normally we need the module id to load the left menu.
        // Let's get the last logged module for this session.
        $lastLog = DB::table('log_user_login_detail')
            ->where('id_log_user', Session::get('id_log_user'))
            ->orderBy('id_log_user_login_detail', 'desc')
            ->first();
            
        $modul = $lastLog ? $lastLog->id_dc_modul : 2; // fallback to 2 (Registrasi)
        
        $module = DB::table('dc_modul')->where('id_dc_modul', $modul)->first();
        $moduleName = $module ? $module->nama_modul : 'Modul';

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
            if (!isset($menus[$row->id_dc_menu])) {
                $menus[$row->id_dc_menu] = [
                    'id_dc_menu' => $row->id_dc_menu,
                    'nama_menu' => $row->nama_menu,
                    'sub_menus' => []
                ];
            }

            if ($row->id_dc_sub_menu) {
                $subExists = false;
                foreach ($menus[$row->id_dc_menu]['sub_menus'] as $sub) {
                    if ($sub['id_dc_sub_menu'] == $row->id_dc_sub_menu) {
                        $subExists = true;
                        break;
                    }
                }
                if (!$subExists) {
                    $menus[$row->id_dc_menu]['sub_menus'][] = [
                        'id_dc_sub_menu' => $row->id_dc_sub_menu,
                        'nama_sub_menu' => $row->nama_sub_menu,
                        'url_sub_menu' => $row->url_sub_menu,
                    ];
                }
            }
        }

        $menus = array_values($menus);

        $path = $legacy_dir . '/' . $legacy_file;
        $queryString = $request->getQueryString();
        $fullPath = $queryString ? $path . '?' . $queryString : $path;

        return inertia('LegacyView', [
            'legacyPath' => $fullPath,
            'module_name' => $moduleName,
            'menus' => $menus
        ]);
    }

    public function showExternal(Request $request)
    {
        $id_dd_user = Session::get('id_dd_user');
        $url = $request->query('url', '#');
        $title = $request->query('title', 'Legacy Module');
        
        $lastLog = DB::table('log_user_login_detail')
            ->where('id_log_user', Session::get('id_log_user'))
            ->orderBy('id_log_user_login_detail', 'desc')
            ->first();
            
        $modul = $lastLog ? $lastLog->id_dc_modul : 2;
        
        $module = DB::table('dc_modul')->where('id_dc_modul', $modul)->first();
        $moduleName = $module ? $module->nama_modul : 'Modul';

        $hakAkses = DB::table('admin_hak_user_v')
            ->select('id_dc_menu','nama_menu','no_urut_menu','id_dc_sub_menu','nama_sub_menu','url_sub_menu','no_urut_sub_menu')
            ->where('id_dd_user', $id_dd_user)
            ->where('id_dc_modul', $modul)
            ->distinct()
            ->orderBy('no_urut_menu')
            ->orderBy('no_urut_sub_menu')
            ->get();

        $menus = [];
        foreach ($hakAkses as $row) {
            if (!isset($menus[$row->id_dc_menu])) {
                $menus[$row->id_dc_menu] = [
                    'id_dc_menu' => $row->id_dc_menu,
                    'nama_menu' => $row->nama_menu,
                    'sub_menus' => []
                ];
            }
            if ($row->id_dc_sub_menu) {
                $subExists = false;
                foreach ($menus[$row->id_dc_menu]['sub_menus'] as $sub) {
                    if ($sub['id_dc_sub_menu'] == $row->id_dc_sub_menu) { $subExists = true; break; }
                }
                if (!$subExists) {
                    $menus[$row->id_dc_menu]['sub_menus'][] = [
                        'id_dc_sub_menu' => $row->id_dc_sub_menu,
                        'nama_sub_menu' => $row->nama_sub_menu,
                        'url_sub_menu' => $row->url_sub_menu,
                    ];
                }
            }
        }
        $menus = array_values($menus);

        return inertia('LegacyView', [
            'legacyPath' => $url,
            'module_name' => $moduleName,
            'menus' => $menus
        ]);
    }
}
