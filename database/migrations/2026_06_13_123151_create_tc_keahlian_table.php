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
        Schema::create('tc_keahlian', function (Blueprint $table) {
            $table->increments('id_tc_keahlian');
            $table->integer('id_dc_bd_keahlian')->nullable();
            $table->text('npp')->nullable();
            $table->string('nama_sertifikat', 50)->nullable();
            $table->string('instansi', 50)->nullable();
            $table->integer('tahun_lulus')->nullable();
            $table->string('nama_bidang', 50)->nullable();
            $table->integer('kode_dokter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_keahlian');
    }
};
