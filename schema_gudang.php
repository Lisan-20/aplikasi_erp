<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = ['tc_permintaan_inst_nm', 'tc_permintaan_inst_nm_det', 'tc_stok_opname_nm', 'tc_pengiriman_distribusi'];
foreach ($tables as $t) {
    echo "TABLE: $t" . PHP_EOL;
    $columns = DB::select("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$t'");
    foreach ($columns as $c) {
        echo "  - " . $c->COLUMN_NAME . " (" . $c->DATA_TYPE . ")" . PHP_EOL;
    }
}
