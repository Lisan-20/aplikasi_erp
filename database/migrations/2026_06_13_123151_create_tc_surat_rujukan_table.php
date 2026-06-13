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
        Schema::create('tc_surat_rujukan', function (Blueprint $table) {
            $table->increments('id_surat_rj');
            $table->string('no_surat', 50)->nullable();
            $table->integer('id_jenis_surat')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->dateTime('tgl_surat')->nullable();
            $table->dateTime('tgl_periksa')->nullable();
            $table->string('nama_pasien', 250)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('kd_dokter', 50)->nullable();
            $table->integer('no_urut_surat')->nullable();
            $table->text('anamnesa')->nullable();
            $table->string('kesadaran', 50)->nullable();
            $table->string('txt_E', 50)->nullable();
            $table->string('txt_M', 50)->nullable();
            $table->string('txt_V', 50)->nullable();
            $table->string('tensi', 50)->nullable();
            $table->string('nadi', 50)->nullable();
            $table->string('respirasi', 50)->nullable();
            $table->string('suhu', 50)->nullable();
            $table->text('pem_penunjang')->nullable();
            $table->string('diagnosa', 50)->nullable();
            $table->text('terapi')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('alasan')->nullable();
            $table->text('kepada')->nullable();
            $table->string('bagian', 50)->nullable();
            $table->text('tmp_rujukan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_surat_rujukan');
    }
};
