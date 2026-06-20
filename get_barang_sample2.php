<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sample = \Illuminate\Support\Facades\DB::table('mt_barang_nm')->limit(5)->get();
echo json_encode($sample, JSON_PRETTY_PRINT);
