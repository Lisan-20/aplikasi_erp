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
        Schema::create('lap_kunjungan_pm_new_temp', function (Blueprint $table) {
            $table->integer('jml_pas')->nullable();
            $table->integer('tgl')->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->string('jen_kelamin', 50)->nullable();
            $table->string('nama_bagian', 50)->nullable();
            $table->string('stat_pasien', 50)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('asal_daftar', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_kunjungan_pm_new_temp');
    }
};
