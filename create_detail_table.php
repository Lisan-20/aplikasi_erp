<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $exists = \Illuminate\Support\Facades\Schema::hasTable('tc_trans_kasir_detail');
    if (!$exists) {
        $sql = "CREATE TABLE tc_trans_kasir_detail (
            id_tc_trans_kasir_detail INT IDENTITY(1,1) PRIMARY KEY,
            no_registrasi BIGINT NOT NULL,
            kode_brg VARCHAR(50) NOT NULL,
            qty DECIMAL(18,2) NOT NULL,
            harga_jual MONEY NOT NULL,
            subtotal MONEY NOT NULL,
            tgl_input DATETIME NOT NULL
        )";
        \Illuminate\Support\Facades\DB::statement($sql);
        echo "Table tc_trans_kasir_detail created successfully.\n";
    } else {
        echo "Table tc_trans_kasir_detail already exists.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
