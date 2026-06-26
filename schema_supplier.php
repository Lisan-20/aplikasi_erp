<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = ['mt_supplier', 'tc_po', 'tc_po_det', 'tc_penerimaan_barang', 'tc_penerimaan_barang_detail'];
foreach ($tables as $t) {
    echo "TABLE: $t\n";
    $columns = DB::select("SELECT COLUMN_NAME, DATA_TYPE FROM information_schema.columns WHERE table_name = '$t'");
    foreach ($columns as $c) {
        echo "  - " . $c->COLUMN_NAME . " (" . $c->DATA_TYPE . ")\n";
    }
    echo "\n";
}
