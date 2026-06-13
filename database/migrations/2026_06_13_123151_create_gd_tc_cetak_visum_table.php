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
        Schema::create('gd_tc_cetak_visum', function (Blueprint $table) {
            $table->increments('id_cetak_visum');
            $table->string('no_visum', 50)->nullable();
            $table->string('kode_dokter', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('permintaan_dari')->nullable();
            $table->string('permintaan_di')->nullable();
            $table->string('permintaan_no', 50)->nullable();
            $table->dateTime('permintaan_tanggal')->nullable();
            $table->string('namanya', 50)->nullable();
            $table->string('bangsanya', 50)->nullable();
            $table->string('jen_kelaminnya', 50)->nullable();
            $table->dateTime('tgl_lhr')->nullable();
            $table->string('alamatnya')->nullable();
            $table->string('uraian_tentang', 2000)->nullable();
            $table->string('diagnosa', 2000)->nullable();
            $table->string('kelainan', 2000)->nullable();
            $table->integer('pilih_a')->nullable();
            $table->integer('pilih_b')->nullable();
            $table->integer('pilih_c')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->string('panca_indra', 50)->nullable();

            $table->primary(['id_cetak_visum'], 'pk_gd_tc_cetak_visum');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gd_tc_cetak_visum');
    }
};
