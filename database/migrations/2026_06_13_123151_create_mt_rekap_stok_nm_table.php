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
        Schema::create('mt_rekap_stok_nm', function (Blueprint $table) {
            $table->integer('kode_rekap_stok');
            $table->string('kode_brg', 20)->nullable();
            $table->integer('jml_sat_kcl')->nullable();
            $table->integer('stok_minimum')->nullable();
            $table->integer('stok_maksimum')->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->decimal('harga_persediaan', 19, 4)->nullable();
            $table->string('kode_bagian_gudang', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_rekap_stok_nm');
    }
};
