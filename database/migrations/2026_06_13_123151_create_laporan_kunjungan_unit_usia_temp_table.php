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
        Schema::create('laporan_kunjungan_unit_usia_temp', function (Blueprint $table) {
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('tgl')->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('jum_pasien')->nullable();
            $table->string('ket', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kunjungan_unit_usia_temp');
    }
};
