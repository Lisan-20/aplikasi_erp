<?php
require '/var/www/html/vendor/autoload.php';
$app = require_once '/var/www/html/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$hakAkses = \Illuminate\Support\Facades\DB::table('admin_hak_user_v')
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
    ->where('id_dc_modul', 10) // Kasir
    ->distinct()
    ->orderBy('no_urut_menu')
    ->orderBy('no_urut_sub_menu')
    ->get();

file_put_contents('/var/www/html/test_menus.json', json_encode($hakAkses, JSON_PRETTY_PRINT));
echo "DONE\n";
