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
    
    // Check if column exists, drop it
    $identity = DB::select("SELECT name FROM sys.columns WHERE object_id = OBJECT_ID('mt_barang_jasa') AND name = 'id_barang'");
    if (count($identity) > 0) {
        // If there's any constraint on id_barang, it would need to be dropped first. We will assume none for now.
        DB::statement('ALTER TABLE mt_barang_jasa DROP COLUMN id_barang');
        echo "Dropped old id_barang column.\n";
    }

    // Add new id_barang with IDENTITY
    DB::statement('ALTER TABLE mt_barang_jasa ADD id_barang INT IDENTITY(1,1) NOT NULL');
    echo "Added new id_barang column with IDENTITY(1,1).\n";

    // Make it UNIQUE
    DB::statement('ALTER TABLE mt_barang_jasa ADD CONSTRAINT UQ_id_barang UNIQUE (id_barang)');
    echo "Added UNIQUE constraint to id_barang.\n";

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
