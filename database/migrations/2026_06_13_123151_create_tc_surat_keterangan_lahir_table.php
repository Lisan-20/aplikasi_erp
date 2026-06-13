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
        Schema::create('tc_surat_keterangan_lahir', function (Blueprint $table) {
            $table->increments('id_srt_lhr');
            $table->bigInteger('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_mr')->nullable();
            $table->string('nm_wali', 100)->nullable();
            $table->integer('umur_wali')->nullable();
            $table->string('pekerjaan_wali', 50)->nullable();
            $table->string('agama_wali', 50)->nullable();
            $table->string('wn', 50)->nullable();
            $table->text('alamat_wali')->nullable();
            $table->string('nm_wali2', 100)->nullable();
            $table->integer('umur_wali2')->nullable();
            $table->string('pekerjaan_wali2', 50)->nullable();
            $table->string('agama_wali2', 50)->nullable();
            $table->string('wn2', 50)->nullable();
            $table->text('alamat_wali2')->nullable();
            $table->string('nikah', 50)->nullable();
            $table->string('jenis_kelamin', 50)->nullable();
            $table->string('anak_ke', 50)->nullable();
            $table->string('tgl_lahir', 50)->nullable();
            $table->string('waktu', 50)->nullable();
            $table->string('bb', 50)->nullable();
            $table->string('panjang', 50)->nullable();
            $table->string('nm_anak', 100)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->integer('user_input')->nullable();
            $table->dateTime('tgl_input')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_surat_keterangan_lahir');
    }
};
