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
        Schema::create('th_serah_terima_jaringan', function (Blueprint $table) {
            $table->increments('id_serah_terima_jaringan');
            $table->dateTime('tgl_serah_terima')->nullable();
            $table->string('hari', 10)->nullable();
            $table->string('nama_pasien', 50)->nullable();
            $table->dateTime('tgl_lahir_pasien')->nullable();
            $table->integer('no_mr')->nullable();
            $table->integer('nasabah')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->integer('dr_operator')->nullable();
            $table->integer('diagnosa')->nullable();
            $table->text('tindakan')->nullable();
            $table->string('saksi', 50)->nullable();
            $table->string('hub_kel', 50)->nullable();
            $table->string('nama_jaringan', 50)->nullable();
            $table->string('uk_jaringan', 50)->nullable();
            $table->string('serah_terima', 50)->nullable();
            $table->string('setuju', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('kode_pet_lab')->nullable();
            $table->integer('kode_petugas_ruangan')->nullable();
            $table->integer('kode_perawat_ibs')->nullable();
            $table->string('no_registrasi', 250)->nullable();
            $table->text('ttd_saksi')->nullable();
            $table->text('ttd_penerima')->nullable();
            $table->dateTime('tgl_jam_ttd_saksi')->nullable();
            $table->dateTime('tgl_jam_ttd_penerima')->nullable();
            $table->text('wali_pasien')->nullable();
            $table->string('hub_kel2', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_serah_terima_jaringan');
    }
};
