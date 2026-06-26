<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$columns = DB::select("SELECT COLUMN_NAME, DATA_TYPE FROM information_schema.columns WHERE table_name = 'mt_account'");
echo "TABLE: mt_account\n";
foreach ($columns as $c) {
    echo "  - " . $c->COLUMN_NAME . " (" . $c->DATA_TYPE . ")\n";
}
echo "\nSAMPLE ROWS:\n";
$rows = DB::table('mt_account')->take(5)->get();
foreach ($rows as $r) {
    echo json_encode($r) . "\n";
}
