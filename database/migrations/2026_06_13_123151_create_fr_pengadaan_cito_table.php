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
        Schema::create('fr_pengadaan_cito', function (Blueprint $table) {
            $table->integer('id_fr_pengadaan_cito');
            $table->string('kode_pengadaan', 50)->nullable();
            $table->dateTime('tgl_pembelian')->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->integer('jumlah_kcl')->nullable();
            $table->decimal('harga_beli', 18, 0)->nullable();
            $table->decimal('total_harga', 18, 0)->nullable();
            $table->decimal('harga_jual', 18, 0)->nullable();
            $table->integer('flag_jurnal')->nullable();
            $table->integer('induk_cito')->nullable();
            $table->string('tempat_pembelian', 50)->nullable();
            $table->integer('status_transaksi')->nullable();

            $table->primary(['id_fr_pengadaan_cito'], 'pk_fr_pengadaan_cito');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_pengadaan_cito');
    }
};
