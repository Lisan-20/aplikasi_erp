<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
config(['database.connections.sqlsrv.host' => '127.0.0.1']);

$tables = \DB::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_NAME LIKE '%retur%'");
echo "Tables with 'retur':\n";
foreach ($tables as $t) {
    echo "- " . $t->TABLE_NAME . "\n";
    $columns = \DB::select("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ?", [$t->TABLE_NAME]);
    foreach ($columns as $c) {
        echo "  - " . $c->COLUMN_NAME . " (" . $c->DATA_TYPE . ")\n";
    }
}
