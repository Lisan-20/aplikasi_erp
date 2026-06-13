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
        Schema::create('tc_kunjungan_tarik', function (Blueprint $table) {
            $table->integer('id_tc_kunjungan');
            $table->integer('no_kunjungan');
            $table->integer('no_registrasi');
            $table->string('no_mr', 8);
            $table->string('kode_dokter', 10)->nullable();
            $table->string('kode_bagian_tujuan', 18)->nullable();
            $table->string('kode_bagian_asal', 18)->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->tinyInteger('status_masuk')->nullable()->comment('kalo rujuk, status_masuk=1; selain itu 0;');
            $table->tinyInteger('status_keluar')->nullable()->comment('meninggal=4; keluar hidup-hidup=3;');
            $table->integer('status_cito')->nullable();
            $table->string('keterangan', 18)->nullable();
            $table->integer('status_batal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kunjungan_tarik');
    }
};
