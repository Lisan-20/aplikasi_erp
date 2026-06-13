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
        Schema::create('tc_penerimaan_gizi_detail', function (Blueprint $table) {
            $table->integer('kode_detail_penerimaan_barang');
            $table->string('kode_brg', 20)->nullable();
            $table->string('kode_penerimaan', 20)->nullable();
            $table->integer('jumlah_pesan')->nullable();
            $table->integer('jumlah_kirim')->nullable();
            $table->integer('bonus_pesan')->nullable();
            $table->integer('bonus_kirim')->nullable();
            $table->integer('bonus_kurang')->nullable();
            $table->integer('content')->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('tgl_kadaluarsa')->nullable();
            $table->integer('id_tc_permohonan_gizi_det')->nullable();
            $table->string('tempat', 100)->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->decimal('harga', 18)->nullable();
            $table->decimal('harga_total', 18)->nullable();

            $table->primary(['kode_detail_penerimaan_barang'], 'pk_tc_penerimaan_gizi_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penerimaan_gizi_detail');
    }
};
