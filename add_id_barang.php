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
    DB::statement('ALTER TABLE mt_barang_jasa ADD id_barang INT IDENTITY(1,1) NOT NULL');
    // If we want to make it unique constraint
    DB::statement('ALTER TABLE mt_barang_jasa ADD CONSTRAINT UQ_id_barang UNIQUE (id_barang)');
    echo "Column id_barang added successfully with IDENTITY and UNIQUE constraint.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
