<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$menus = DB::table('dc_menu_sub')->where('url', 'like', '%gudang%')->get();
foreach ($menus as $m) {
    echo $m->nama_sub_menu . " -> " . $m->url . "\n";
}
