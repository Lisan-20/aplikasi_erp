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
        Schema::create('tc_kunjungan_terapi', function (Blueprint $table) {
            $table->increments('id_terapi');
            $table->dateTime('tgl_awal')->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->integer('kode_tarif')->nullable();
            $table->string('nama_tarif', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kunjungan_terapi');
    }
};
