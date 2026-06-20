<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $sql = "ALTER TABLE tc_trans_kasir_detail ADD kode_tc_trans_kasir INT NULL";
    \Illuminate\Support\Facades\DB::statement($sql);
    echo "Column kode_tc_trans_kasir added successfully.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
