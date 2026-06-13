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
        Schema::create('th_pengawasan_his', function (Blueprint $table) {
            $table->string('no_mr', 10)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->dateTime('tgl_his')->nullable();
            $table->float('tensi', 53, 0)->nullable();
            $table->float('nadi', 53, 0)->nullable();
            $table->integer('frekuensi')->nullable();
            $table->integer('lama_detik')->nullable();
            $table->string('kekuatan', 500)->nullable();
            $table->string('relaksasi', 500)->nullable();
            $table->string('bjj', 100)->nullable();
            $table->string('tetesan', 50)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->string('kode_his', 5)->nullable();
            $table->integer('id_th_pengawasan_his')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_pengawasan_his');
    }
};
