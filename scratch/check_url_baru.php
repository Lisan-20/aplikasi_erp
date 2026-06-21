<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

$total = DB::table('dc_sub_menu')->count();
$isi = DB::table('dc_sub_menu')->whereNotNull('url_sub_menu_baru')->where('url_sub_menu_baru', '<>', '')->count();
$kosong = $total - $isi;

echo "Total sub menu         : $total\n";
echo "url_sub_menu_baru isi  : $isi\n";
echo "url_sub_menu_baru kosong: $kosong\n\n";

// Tampilkan sampel yang SUDAH terisi
echo "=== SAMPLE YANG SUDAH ADA url_sub_menu_baru ===\n";
$sample = DB::table('dc_sub_menu')
    ->whereNotNull('url_sub_menu_baru')
    ->where('url_sub_menu_baru', '<>', '')
    ->select('id_dc_sub_menu', 'nama_sub_menu', 'url_sub_menu', 'url_sub_menu_baru')
    ->limit(20)->get();
foreach ($sample as $r) {
    echo "  [{$r->id_dc_sub_menu}] {$r->nama_sub_menu} => {$r->url_sub_menu_baru}\n";
}
