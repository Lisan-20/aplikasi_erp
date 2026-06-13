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
        Schema::create('tc_pemesanan_gizi_det', function (Blueprint $table) {
            $table->bigIncrements('id_tc_pemesanan_det');
            $table->bigInteger('id_tc_pemesanan')->nullable();
            $table->decimal('jumlah_pesan', 18)->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->string('satuan', 50)->nullable();
            $table->dateTime('tgl_kirim')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->decimal('kekurangan', 18)->nullable();
            $table->decimal('jumlah_penerimaan', 18)->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->decimal('harga_beli', 18)->nullable();
            $table->decimal('harga_jual', 18)->nullable();
            $table->string('distribusi', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemesanan_gizi_det');
    }
};
