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
        if (Schema::hasTable('tc_pemeriksaan_ews_det')) {
            return;
        }

        Schema::create('tc_pemeriksaan_ews_det', function (Blueprint $table) {
            $table->increments('kode_tc_periksa');
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
            $table->string('warna', 50)->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->integer('no_urut_ews')->nullable();
            $table->string('kd_EWS_lev2', 50)->nullable();
            $table->string('kd_EWS_lev3', 50)->nullable();
            $table->integer('skor')->nullable();
            $table->integer('id_triase')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemeriksaan_ews_det');
    }
};
