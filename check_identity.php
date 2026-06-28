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
    $identity = DB::select("SELECT is_identity FROM sys.columns WHERE object_id = OBJECT_ID('mt_barang_jasa') AND name = 'id_barang'");
    
    if (count($identity) > 0) {
        echo "id_barang is_identity: " . $identity[0]->is_identity . "\n";
    } else {
        echo "Column id_barang not found.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
