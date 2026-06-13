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
        Schema::create('tc_pemeriksaan_dokter', function (Blueprint $table) {
            $table->increments('kode_tc_periksa');
            $table->integer('id_mt_kd')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable()->index('ix_no_kunjungan');
            $table->string('kode_pemeriksaan', 50)->nullable()->index('ix_kode_pemeriksaan');
            $table->string('nama_pemeriksaan', 250)->nullable();
            $table->integer('kd_lev')->nullable();
            $table->integer('kd_type')->nullable();
            $table->string('hasil', 50)->nullable();
            $table->string('ket', 50)->nullable();
            $table->string('hasil2', 50)->nullable();
            $table->string('no_urut_entry', 50)->nullable();
            $table->integer('kd_kk')->nullable();
            $table->string('no_registrasi', 50)->nullable()->index('ix_no_registrasi');
            $table->string('ket_hasil_bmi', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemeriksaan_dokter');
    }
};
