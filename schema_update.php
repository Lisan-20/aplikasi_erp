<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // 1. Rename table
    DB::statement("EXEC sp_rename 'tc_stok_opname_nm', 'tc_stok_opname_brg'");
    echo "Table renamed to tc_stok_opname_brg.\n";
    
    // 2. Rename column id_dd_user to no_induk
    DB::statement("EXEC sp_rename 'tc_stok_opname_brg.id_dd_user', 'no_induk', 'COLUMN'");
    
    // 3. Change no_induk data type from int to varchar (since it's a string, e.g., '102.100914')
    DB::statement("ALTER TABLE tc_stok_opname_brg ALTER COLUMN no_induk VARCHAR(50)");
    
    echo "Column id_dd_user renamed to no_induk and changed to VARCHAR(50).\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
