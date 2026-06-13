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
        Schema::create('dc_transaksi_detail', function (Blueprint $table) {
            $table->increments('id_kd_transaksi_det');
            $table->integer('id_kd_transaksi')->nullable();
            $table->string('nama_transkasi', 50)->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->string('nama_transaksi', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_transaksi_detail');
    }
};
