<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

if (!Schema::hasTable('tc_erp_pembayaran_piutang')) {
    Schema::create('tc_erp_pembayaran_piutang', function (Blueprint $table) {
        $table->id();
        $table->string('no_faktur', 100);
        $table->date('tgl_bayar');
        $table->decimal('nominal_bayar', 18, 2);
        $table->bigInteger('id_coa_tujuan'); // Akun Kas/Bank
        $table->string('petugas', 100)->nullable();
        $table->timestamps();
    });
    echo "Table tc_erp_pembayaran_piutang created successfully!\n";
} else {
    echo "Table tc_erp_pembayaran_piutang already exists.\n";
}
