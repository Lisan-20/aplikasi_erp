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
        Schema::create('tindakan_fisik', function (Blueprint $table) {
            $table->integer('id_tindakan_fisik');
            $table->string('kode_pemeriksaan', 50)->nullable();
            $table->string('nama_pemeriksaan')->nullable();
            $table->string('referensi', 50)->nullable();
            $table->integer('tingkatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindakan_fisik');
    }
};
