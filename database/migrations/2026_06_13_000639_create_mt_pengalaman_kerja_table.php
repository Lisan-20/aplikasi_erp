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
        if (Schema::hasTable('mt_pengalaman_kerja')) {
            return;
        }

        Schema::create('mt_pengalaman_kerja', function (Blueprint $table) {
            $table->increments('id_mt_pengalaman_kerja');
            $table->string('tempat_bekerja', 50)->nullable();
            $table->string('posisi', 50)->nullable();
            $table->integer('tahun')->nullable();
            $table->string('asal_instansi', 50)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->string('npp', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_pengalaman_kerja');
    }
};
