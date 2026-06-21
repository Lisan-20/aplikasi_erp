<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

try {
    $sql = 'ALTER TABLE tc_trans_kasir_detail ADD kode_tc_trans_kasir INT NULL';
    DB::statement($sql);
    echo "Column kode_tc_trans_kasir added successfully.\n";
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage()."\n";
}
