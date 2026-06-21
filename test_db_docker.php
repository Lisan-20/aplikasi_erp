<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$submenus = DB::table('dc_sub_menu')
    ->where('nama_sub_menu', 'like', '%Kasir%')
    ->select('nama_sub_menu', 'url_sub_menu', 'url_sub_menu_baru')
    ->get();
print_r($submenus->toArray());
