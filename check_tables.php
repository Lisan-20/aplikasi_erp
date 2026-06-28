<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

try {
    Config::set('database.connections.sqlsrv.host', '127.0.0.1');
    DB::purge('sqlsrv');
    
    echo "--- tc_permintaan_inst_nm ---\n";
    $cols1 = DB::select("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'tc_permintaan_inst_nm'");
    foreach ($cols1 as $col) echo $col->COLUMN_NAME . " (" . $col->DATA_TYPE . ")\n";

    echo "\n--- mt_depo_stok_brg_jasa ---\n";
    $cols2 = DB::select("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'mt_depo_stok_brg_jasa'");
    foreach ($cols2 as $col) echo $col->COLUMN_NAME . " (" . $col->DATA_TYPE . ")\n";
    
    echo "\n--- mt_barang_jasa ---\n";
    $cols3 = DB::select("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'mt_barang_jasa'");
    foreach ($cols3 as $col) echo $col->COLUMN_NAME . " (" . $col->DATA_TYPE . ")\n";

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
