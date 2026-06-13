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
        Schema::create('riwayat_kes_kar', function (Blueprint $table) {
            $table->increments('id_riwayat_kes_kar');
            $table->string('nama_penyakit', 50)->nullable();
            $table->string('tindakan', 50)->nullable();
            $table->integer('tahun')->nullable();
            $table->string('id_status_skrng', 50)->nullable();
            $table->integer('npp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kes_kar');
    }
};
