<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

if (!Schema::hasTable('tc_erp_penjualan_b2b')) {
    Schema::create('tc_erp_penjualan_b2b', function (Blueprint $table) {
        $table->id();
        $table->string('no_faktur', 50)->unique();
        $table->date('tgl_faktur');
        $table->date('tgl_jatuh_tempo')->nullable();
        $table->string('kode_perusahaan', 50)->nullable();
        $table->text('keterangan')->nullable();
        $table->decimal('total_tagihan', 15, 2)->default(0);
        $table->string('status_pembayaran', 20)->default('Belum Bayar'); // Belum Bayar, Parsial, Lunas
        $table->decimal('total_dibayar', 15, 2)->default(0);
        $table->string('created_by', 50)->nullable();
        $table->timestamps();
    });
    echo "Created tc_erp_penjualan_b2b\n";
}

if (!Schema::hasTable('tc_erp_penjualan_b2b_detail')) {
    Schema::create('tc_erp_penjualan_b2b_detail', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_penjualan');
        $table->string('kode_brg', 50);
        $table->integer('qty');
        $table->decimal('harga', 15, 2);
        $table->decimal('subtotal', 15, 2);
        
        $table->foreign('id_penjualan')->references('id')->on('tc_erp_penjualan_b2b')->onDelete('cascade');
    });
    echo "Created tc_erp_penjualan_b2b_detail\n";
}

echo "Done.\n";
