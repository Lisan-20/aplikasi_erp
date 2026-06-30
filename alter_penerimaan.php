<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

if (!Schema::hasColumn('tc_penerimaan_barang_nm', 'status_tukar_faktur')) {
    Schema::table('tc_penerimaan_barang_nm', function (Blueprint $table) {
        $table->tinyInteger('status_tukar_faktur')->default(0)->nullable();
    });
    echo "Added status_tukar_faktur to tc_penerimaan_barang_nm\n";
} else {
    echo "Column already exists.\n";
}
