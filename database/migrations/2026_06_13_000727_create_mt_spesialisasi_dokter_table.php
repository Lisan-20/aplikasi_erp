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
        if (Schema::hasTable('mt_spesialisasi_dokter')) {
            return;
        }

        Schema::create('mt_spesialisasi_dokter', function (Blueprint $table) {
            $table->increments('id_mt_spesialisasi_dokter');
            $table->integer('kode_spesialisasi')->nullable();
            $table->string('nama_spesialisasi', 50)->nullable();
            $table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_spesialisasi_dokter');
    }
};
