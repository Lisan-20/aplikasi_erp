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
        Schema::create('mt_icd_jenis_penyakit', function (Blueprint $table) {
            $table->integer('kode_penyakit')->nullable();
            $table->string('kode_jenis_penyakit', 50)->nullable();
            $table->string('nama_jenis_penyakit', 50)->nullable();
            $table->integer('status_aktif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_icd_jenis_penyakit');
    }
};
