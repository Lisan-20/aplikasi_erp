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
        Schema::create('tc_kirim_retur_rekanan', function (Blueprint $table) {
            $table->integer('id_kirim_retur_rekanan')->nullable();
            $table->dateTime('tgl')->nullable();
            $table->string('kode_barang', 50)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('nomor_permintaan', 50)->nullable();
            $table->string('nomor_pengiriman', 50)->nullable();
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->string('ket', 100)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('id_tc_permintaan_rekanan_det')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kirim_retur_rekanan');
    }
};
