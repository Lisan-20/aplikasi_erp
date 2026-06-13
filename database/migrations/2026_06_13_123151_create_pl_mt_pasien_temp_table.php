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
        Schema::create('pl_mt_pasien_temp', function (Blueprint $table) {
            $table->integer('kode_poli')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('no_antrian')->nullable();
            $table->dateTime('tgl_jam_poli')->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->string('nama_pasien', 250)->nullable();
            $table->string('nama_poli', 250)->nullable();
            $table->string('nama_dokter', 250)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->string('kode_bagian_poli', 50)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('no_induk_dokter')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('no_induk')->nullable();
            $table->integer('status_periksa')->nullable();
            $table->integer('filter_verif_ol')->nullable();
            $table->integer('status_bayar')->nullable();
            $table->string('kode_jadwal', 50)->nullable();
            $table->integer('status_blpl')->nullable();
            $table->integer('daftar_ol')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pl_mt_pasien_temp');
    }
};
