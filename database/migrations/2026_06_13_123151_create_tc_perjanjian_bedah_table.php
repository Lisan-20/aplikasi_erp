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
        if (Schema::hasTable('tc_perjanjian_bedah')) {
            return;
        }

        Schema::create('tc_perjanjian_bedah', function (Blueprint $table) {
            $table->increments('id_perjanjian');
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('kode_booking', 50)->nullable();
            $table->dateTime('tgl_operasi')->nullable();
            $table->string('jenis_tindakan', 50)->nullable();
            $table->string('kode_bagian_poli', 10)->nullable();
            $table->integer('terlaksana')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_perjanjian_bedah');
    }
};
