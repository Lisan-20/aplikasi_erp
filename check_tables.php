<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_name LIKE '%hutang%' OR table_name LIKE '%bayar%' OR table_name LIKE '%pelunasan%'");
foreach ($tables as $t) {
    echo $t->table_name . "\n";
    print_r(Schema::getColumnListing($t->table_name));
}
