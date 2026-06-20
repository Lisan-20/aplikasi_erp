<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$count = \Illuminate\Support\Facades\DB::table('mt_barang_nm')->count();
$sample = \Illuminate\Support\Facades\DB::table('mt_barang_nm')->whereNotNull('harga_jual')->limit(5)->get();

echo json_encode(['count' => $count, 'sample' => $sample], JSON_PRETTY_PRINT);
