<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

if (!Schema::hasColumn('transaksi_hutang', 'total_bayar')) {
    Schema::table('transaksi_hutang', function (Blueprint $table) {
        $table->decimal('total_bayar', 20, 2)->default(0)->nullable();
    });
    
    // Sync existing status_bayar = 1 to have total_bayar = total
    DB::table('transaksi_hutang')->where('status_bayar', 1)->update([
        'total_bayar' => DB::raw('total')
    ]);
    
    echo "Added total_bayar to transaksi_hutang\n";
} else {
    echo "Column total_bayar already exists.\n";
}
