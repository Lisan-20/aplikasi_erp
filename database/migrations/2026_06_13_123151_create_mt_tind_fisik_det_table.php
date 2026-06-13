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
        Schema::create('mt_tind_fisik_det', function (Blueprint $table) {
            $table->integer('id_mt_tind_fisik');
            $table->integer('kode_pemeriksaan')->nullable();
            $table->string('nama_pemeriksaan_det')->nullable();
            $table->integer('referensi')->nullable();
            $table->integer('tingkatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_tind_fisik_det');
    }
};
