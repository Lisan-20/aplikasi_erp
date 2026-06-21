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
        if (Schema::hasTable('tc_permintaan_kerohanian')) {
            return;
        }

        Schema::create('tc_permintaan_kerohanian', function (Blueprint $table) {
            $table->increments('id_permintaan_kerohanian');
            $table->string('no_mr', 8)->nullable();
            $table->string('no_registrasi', 25)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->dateTime('tgl_minta')->nullable();
            $table->dateTime('tgl_datang')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('nm_petugas', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_permintaan_kerohanian');
    }
};
