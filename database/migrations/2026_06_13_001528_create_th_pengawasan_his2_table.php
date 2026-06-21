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
        if (Schema::hasTable('th_pengawasan_his2')) {
            return;
        }

        Schema::create('th_pengawasan_his2', function (Blueprint $table) {
            $table->increments('no_urut');
            $table->string('no_mr', 10)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->dateTime('tgl_his')->nullable();
            $table->string('tensi', 50)->nullable();
            $table->string('nadi', 50)->nullable();
            $table->string('frekuensi', 50)->nullable();
            $table->string('lama_detik', 50)->nullable();
            $table->string('kekuatan', 100)->nullable();
            $table->string('relaksasi', 100)->nullable();
            $table->string('djj', 100)->nullable();
            $table->string('tetesan', 50)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->string('diagnosa', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_pengawasan_his2');
    }
};
