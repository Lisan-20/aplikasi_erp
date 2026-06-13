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
        Schema::create('mt_master_pasien_jkn_tmp', function (Blueprint $table) {
            $table->increments('id_pasien_jkn');
            $table->string('no_mr_int', 50)->nullable();
            $table->string('nama_pasien', 50)->nullable();
            $table->string('nomorkartu', 50)->nullable();
            $table->string('ktp', 50)->nullable();
            $table->string('notlp', 50)->nullable();
            $table->dateTime('tgl_R_periksa')->nullable();
            $table->string('kodepoli', 50)->nullable();
            $table->string('nomorreferensi', 50)->nullable();
            $table->integer('jenisreferensi')->nullable();
            $table->integer('jenisrequest')->nullable();
            $table->string('polieksekutif', 50)->nullable();
            $table->text('keluhan')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->text('alasan_batal')->nullable();
            $table->string('user_batal', 50)->nullable();
            $table->dateTime('tgl_validasi')->nullable();
            $table->integer('status_batal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_pasien_jkn_tmp');
    }
};
