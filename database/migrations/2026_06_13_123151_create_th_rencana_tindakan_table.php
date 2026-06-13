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
        Schema::create('th_rencana_tindakan', function (Blueprint $table) {
            $table->increments('id_rencana_tindakan');
            $table->string('diagnosa', 250)->nullable();
            $table->string('nama_tindakan', 250)->nullable();
            $table->string('kriteria', 25)->nullable();
            $table->string('sifat', 25)->nullable();
            $table->string('anestesi', 25)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('id_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_rencana_tindakan');
    }
};
