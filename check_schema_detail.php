<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$exists = \Illuminate\Support\Facades\Schema::hasTable('tc_trans_kasir_detail');
$columns = [];
if ($exists) {
    $columns = \Illuminate\Support\Facades\DB::select("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'tc_trans_kasir_detail'");
}

echo json_encode(['exists' => $exists, 'columns' => $columns], JSON_PRETTY_PRINT);
