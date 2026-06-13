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
        Schema::create('mt_tindakan_fisik', function (Blueprint $table) {
            $table->integer('id_mt_tindakan_fisik');
            $table->string('kode_pemeriksaan', 50);
            $table->string('nama_pemeriksaan')->nullable();
            $table->integer('referensi')->nullable();
            $table->integer('tingkatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_tindakan_fisik');
    }
};
