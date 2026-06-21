<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$count = DB::table('mt_barang_nm')->count();
$sample = DB::table('mt_barang_nm')->whereNotNull('harga_jual')->limit(5)->get();

echo json_encode(['count' => $count, 'sample' => $sample], JSON_PRETTY_PRINT);
