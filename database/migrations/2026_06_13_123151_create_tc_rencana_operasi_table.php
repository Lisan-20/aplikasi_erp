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
        Schema::create('tc_rencana_operasi', function (Blueprint $table) {
            $table->increments('id_rencana_operasi');
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->string('nama_pasien', 50)->nullable();
            $table->dateTime('tgl_rencana')->nullable();
            $table->integer('status')->nullable();
            $table->string('jenis_op', 50)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('kode_booking', 50)->nullable();
            $table->string('kode_bagian_poli', 10)->nullable();
            $table->string('init', 10)->nullable();
            $table->integer('flag_kirim_th')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_rencana_operasi');
    }
};
