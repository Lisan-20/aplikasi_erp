<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tc_retur_supplier', function (Blueprint $table) {
            $table->increments('id_tc_retur_supplier');
            $table->dateTime('tgl')->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->string('kodesupplier', 50)->nullable();
            $table->string('no_po')->nullable();
            $table->string('no_lpb')->nullable();
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->string('ket', 50)->nullable();
            $table->integer('sudah_terima')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('kode_detail_penerimaan_barang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_retur_supplier');
    }
};
