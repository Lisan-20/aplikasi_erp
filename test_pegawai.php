<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$menus = DB::table('dc_sub_menu')->where('nama_sub_menu', 'like', '%pegawai%')->get();
foreach ($menus as $m) {
    echo "{$m->id_dc_sub_menu} | {$m->nama_sub_menu} | {$m->url_sub_menu_baru}\n";
}
