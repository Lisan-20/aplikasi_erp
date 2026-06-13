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
        Schema::create('tc_jadwal_dokter', function (Blueprint $table) {
            $table->integer('id_jadwal');
            $table->integer('kode_dokter')->nullable();
            $table->string('nama_dokter', 50)->nullable();
            $table->dateTime('tgl_praktek')->nullable();
            $table->integer('flag_aktif')->nullable();
            $table->string('kode_bagian', 6)->nullable();
            $table->integer('group_medis')->nullable();
            $table->string('kode_jadwal', 3)->nullable();
            $table->dateTime('tgl_selesai')->nullable();
            $table->integer('flag_ver')->nullable();
            $table->integer('flag_sppu')->nullable();
            $table->integer('no_sppu')->nullable();
            $table->integer('tahun')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_jadwal_dokter');
    }
};
