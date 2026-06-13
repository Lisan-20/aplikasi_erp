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
        Schema::create('mt_barang_asset', function (Blueprint $table) {
            $table->string('kode_brg', 20);
            $table->string('kode_pabrik', 20)->nullable();
            $table->string('nama_brg', 200)->nullable();
            $table->string('kode_kategori', 20)->nullable();
            $table->string('satuan_besar', 20)->nullable();
            $table->string('satuan_kecil', 20)->nullable();
            $table->string('merk', 100)->nullable();
            $table->string('buatan', 100)->nullable();
            $table->integer('flag_asset')->nullable();
            $table->string('supplier', 50)->nullable();
            $table->date('tgl_beli')->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->integer('tahun_beli')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_barang_asset');
    }
};
