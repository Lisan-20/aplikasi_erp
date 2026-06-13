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
        Schema::create('tc_dpjp_rinap', function (Blueprint $table) {
            $table->increments('kd_dpjp');
            $table->integer('kode_ri')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('no_mr', 6)->nullable();
            $table->string('dr_merawat', 10)->nullable();
            $table->dateTime('tgl_mulai')->nullable();
            $table->dateTime('tgl_selesai')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->integer('user_dtg')->nullable();
            $table->string('kode_ruangan', 6)->nullable();
            $table->string('bag_pas', 50)->nullable();
            $table->integer('kelas_pas')->nullable()->default(0);
            $table->integer('kode_jenis_dpjp')->nullable();
            $table->integer('no_registrasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_dpjp_rinap');
    }
};
