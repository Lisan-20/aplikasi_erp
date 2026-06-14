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
        if (Schema::hasTable('mt_rekap_stok_temp')) {
            return;
        }

        Schema::create('mt_rekap_stok_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_bagian', 18)->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->decimal('saldo_awal', 18)->nullable();
            $table->decimal('pemasukan', 18)->nullable();
            $table->decimal('pengeluaran', 18)->nullable();
            $table->decimal('saldo_akhir', 18)->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->string('nama_barang', 250)->nullable();
            $table->string('sat_kecil', 50)->nullable();
            $table->decimal('harga_beli', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_rekap_stok_temp');
    }
};
