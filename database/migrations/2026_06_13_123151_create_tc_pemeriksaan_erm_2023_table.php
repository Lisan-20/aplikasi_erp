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
        Schema::create('tc_pemeriksaan_erm_2023', function (Blueprint $table) {
            $table->integer('kode_tc_periksa')->nullable();
            $table->integer('id_mt_kd')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->string('kode_pemeriksaan', 50)->nullable();
            $table->string('nama_pemeriksaan', 250)->nullable();
            $table->integer('kd_lev')->nullable();
            $table->integer('kd_type')->nullable();
            $table->string('ket', 50)->nullable();
            $table->text('hasil')->nullable();
            $table->text('hasil2')->nullable();
            $table->string('no_urut_entry', 50)->nullable();
            $table->integer('kd_kk')->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->integer('id_info')->nullable();
            $table->string('ket_hasil_bmi', 50)->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->integer('id_triase')->nullable();
            $table->integer('sekor')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->integer('no_urut')->nullable();
            $table->dateTime('tgl_update')->nullable();
            $table->integer('kode_rm_inp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemeriksaan_erm_2023');
    }
};
