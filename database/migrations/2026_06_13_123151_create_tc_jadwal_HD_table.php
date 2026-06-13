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
        Schema::create('tc_jadwal_HD', function (Blueprint $table) {
            $table->increments('id_surat');
            $table->string('no_mr', 8)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->dateTime('tgl_surat')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('tgl_1', 50)->nullable();
            $table->string('tgl_2', 50)->nullable();
            $table->string('tgl_3', 50)->nullable();
            $table->string('tgl_4', 50)->nullable();
            $table->string('tgl_5', 50)->nullable();
            $table->string('tgl_6', 50)->nullable();
            $table->string('tgl_7', 50)->nullable();
            $table->string('tgl_8', 50)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->string('diagnosa', 250)->nullable();
            $table->string('tgl_9', 50)->nullable();
            $table->string('tgl_10', 50)->nullable();
            $table->string('tgl_11', 50)->nullable();
            $table->string('tgl_12', 50)->nullable();
            $table->string('tgl_13', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_jadwal_HD');
    }
};
