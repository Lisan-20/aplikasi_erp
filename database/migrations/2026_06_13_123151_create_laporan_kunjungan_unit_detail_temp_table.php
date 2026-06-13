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
        if (Schema::hasTable('laporan_kunjungan_unit_detail_temp')) {
            return;
        }

        Schema::create('laporan_kunjungan_unit_detail_temp', function (Blueprint $table) {
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('tgl')->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('jml_pasien')->nullable();
            $table->integer('laki')->nullable();
            $table->integer('wanita')->nullable();
            $table->integer('anak')->nullable();
            $table->integer('dewasa')->nullable();
            $table->integer('lama')->nullable();
            $table->integer('baru')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kunjungan_unit_detail_temp');
    }
};
