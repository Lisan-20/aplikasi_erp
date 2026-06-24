<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$result1 = Illuminate\Support\Facades\DB::select("SELECT table_name FROM information_schema.tables WHERE table_name LIKE '%_brg_jasa%'");
echo "Tables with _brg_jasa:\n";
foreach($result1 as $row) {
    echo $row->table_name . "\n";
}

$result2 = Illuminate\Support\Facades\DB::select("SELECT table_name FROM information_schema.tables WHERE table_name LIKE '%_nm%'");
echo "\nTables with _nm:\n";
foreach($result2 as $row) {
    echo $row->table_name . "\n";
}
