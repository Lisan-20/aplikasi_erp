<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require '/var/www/html/vendor/autoload.php';
$app = require_once '/var/www/html/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$hakAkses = DB::table('admin_hak_user_v')
    ->join('dc_sub_menu', 'admin_hak_user_v.id_dc_sub_menu', '=', 'dc_sub_menu.id_dc_sub_menu')
    ->select(
        'admin_hak_user_v.id_dc_menu',
        'admin_hak_user_v.nama_menu',
        'admin_hak_user_v.no_urut_menu',
        'admin_hak_user_v.id_dc_sub_menu',
        'admin_hak_user_v.nama_sub_menu',
        'admin_hak_user_v.url_sub_menu',
        'dc_sub_menu.url_sub_menu_baru',
        'admin_hak_user_v.no_urut_sub_menu'
    )
    ->where('id_dd_user', 1)
    ->where('id_dc_modul', 36) // Modul Admin
    ->distinct()
    ->orderBy('no_urut_menu')
    ->orderBy('no_urut_sub_menu')
    ->get();

$menus = [];
foreach ($hakAkses as $row) {
    if (! isset($menus[$row->id_dc_menu])) {
        $menus[$row->id_dc_menu] = [
            'id_dc_menu' => $row->id_dc_menu,
            'nama_menu' => $row->nama_menu,
            'sub_menus' => [],
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
        if (! $subExists) {
            $menus[$row->id_dc_menu]['sub_menus'][] = [
                'id_dc_sub_menu' => $row->id_dc_sub_menu,
                'nama_sub_menu' => $row->nama_sub_menu,
                'url_sub_menu' => $row->url_sub_menu,
                'url_sub_menu_baru' => $row->url_sub_menu_baru,
            ];
        }
    }
}
$menus = array_values($menus);
echo json_encode($menus, JSON_PRETTY_PRINT);
