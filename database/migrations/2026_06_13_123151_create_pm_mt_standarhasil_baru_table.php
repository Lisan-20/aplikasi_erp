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
        Schema::create('pm_mt_standarhasil_baru', function (Blueprint $table) {
            $table->string('kode_mt_hasilpm')->nullable();
            $table->string('kode_tarif')->nullable();
            $table->string('nama_pemeriksaan')->nullable();
            $table->string('kode_bagian')->nullable();
            $table->text('standar_hasil_wanita')->nullable();
            $table->string('standar_hasil_pria', 500)->nullable();
            $table->string('satuan')->nullable();
            $table->integer('urutan')->nullable();
            $table->string('kode_tindakan', 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_mt_standarhasil_baru');
    }
};
