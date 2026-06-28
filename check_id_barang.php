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
    $result = DB::select("SELECT COUNT(*) as total_rows, COUNT(id_barang) as non_null_id FROM mt_barang_jasa");
    echo "Total Rows: " . $result[0]->total_rows . "\n";
    echo "Non-Null id_barang: " . $result[0]->non_null_id . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
