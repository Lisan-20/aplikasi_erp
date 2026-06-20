<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$submenus = \Illuminate\Support\Facades\DB::table('dc_sub_menu')->get();
$mapped = [];
$unmapped = [];
foreach($submenus as $sub) {
    if ($sub->url_sub_menu_baru) {
        $mapped[] = $sub;
    } else {
        $unmapped[] = $sub;
    }
}
echo "Mapped Sub Menus: " . count($mapped) . "\n";
echo "Unmapped Sub Menus: " . count($unmapped) . "\n";
foreach($mapped as $m) {
    echo $m->nama_sub_menu . " -> " . $m->url_sub_menu_baru . "\n";
}
