<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$submenus = DB::table('dc_sub_menu')
    ->select('id_dc_sub_menu', 'nama_sub_menu', 'url_sub_menu', 'url_sub_menu_baru')
    ->where('nama_sub_menu', 'like', '%Kasir%')
    ->orWhere('nama_sub_menu', 'like', '%User%')
    ->take(10)
    ->get();

print_r($submenus->toArray());
