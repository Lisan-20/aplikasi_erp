<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$submenus = \Illuminate\Support\Facades\DB::table('dc_sub_menu')
    ->where('nama_sub_menu', 'like', '%Kasir%')
    ->select('nama_sub_menu', 'url_sub_menu', 'url_sub_menu_baru')
    ->get();
print_r($submenus->toArray());
