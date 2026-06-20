<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$barangColumns = \Illuminate\Support\Facades\DB::select("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'mt_barang_nm'");
$kasirColumns = \Illuminate\Support\Facades\DB::select("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'tc_trans_kasir'");

echo json_encode(['barang' => $barangColumns, 'kasir' => $kasirColumns], JSON_PRETTY_PRINT);
