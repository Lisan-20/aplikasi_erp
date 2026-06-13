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
        Schema::create('dc_riwayat_pendidikan', function (Blueprint $table) {
            $table->increments('id_riwayat_pendidikan');
            $table->integer('id_dc_pendidikan')->nullable();
            $table->text('npp2')->nullable();
            $table->string('nama_sekolah', 50)->nullable();
            $table->text('lokasi_sekolah')->nullable();
            $table->integer('tahun_lulus')->nullable();
            $table->string('kode_dokter', 50)->nullable();
            $table->bigInteger('npp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_riwayat_pendidikan');
    }
};
