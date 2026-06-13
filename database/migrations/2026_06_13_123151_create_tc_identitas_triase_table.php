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
        Schema::create('tc_identitas_triase', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_pasien', 150)->nullable();
            $table->integer('umur')->nullable();
            $table->string('alamat', 250)->nullable();
            $table->integer('id_triase')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('warna', 50)->nullable();
            $table->string('kat_triase', 250)->nullable();
            $table->integer('user_id')->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->string('jen_kel', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_identitas_triase');
    }
};
