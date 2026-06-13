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
        if (Schema::hasTable('pm_mt_standarhasil_det')) {
            return;
        }

        Schema::create('pm_mt_standarhasil_det', function (Blueprint $table) {
            $table->string('kode_mt_hasilpm_det')->nullable();
            $table->string('kode_mt_hasilpm')->nullable();
            $table->string('kode_tarif')->nullable();
            $table->string('nama_pemeriksaan_det')->nullable();
            $table->string('kode_bagian')->nullable();
            $table->string('standar_hasil_wanita_det', 500)->nullable();
            $table->string('standar_hasil_pria_det', 500)->nullable();
            $table->string('satuan_det')->nullable();
            $table->integer('urutan_det')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_mt_standarhasil_det');
    }
};
