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
        if (Schema::hasTable('laporan_kunjungan_unit_sex_temp')) {
            return;
        }

        Schema::create('laporan_kunjungan_unit_sex_temp', function (Blueprint $table) {
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('tgl')->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('jen_kelamin_up')->nullable();
            $table->string('jen_kelamin', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kunjungan_unit_sex_temp');
    }
};
