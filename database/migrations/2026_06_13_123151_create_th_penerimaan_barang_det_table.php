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
        Schema::create('th_penerimaan_barang_det', function (Blueprint $table) {
            $table->integer('id_th_penerimaan_barang_det');
            $table->integer('kode_detail_penerimaan_barang')->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->integer('jml_barang')->nullable();
            $table->string('kode_penerimaan', 50)->nullable();
            $table->dateTime('tgl_kadaluarsa_lama')->nullable();
            $table->dateTime('tgl_kadaluarsa_baru')->nullable();
            $table->string('no_induk', 50)->nullable();
            $table->dateTime('input_date')->nullable();
            $table->tinyInteger('flag_expired')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_penerimaan_barang_det');
    }
};
