<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

Config::set('database.connections.sqlsrv.host', '127.0.0.1');

try {
    DB::statement('ALTER TABLE tc_kartu_stok_brg_jasa ADD harga_hpp FLOAT NULL');
    echo "Column harga_hpp added successfully.\n";
} catch (\Exception $e) {
    if (strpos($e->getMessage(), 'already exists') !== false || strpos($e->getMessage(), 'Column names in each table must be unique') !== false) {
        echo "Column harga_hpp already exists.\n";
    } else {
        echo "Error: " . $e->getMessage() . "\n";
    }
}
