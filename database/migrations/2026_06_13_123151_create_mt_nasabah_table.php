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
        Schema::create('mt_nasabah', function (Blueprint $table) {
            $table->increments('id_mt_nasabah');
            $table->integer('kode_kelompok');
            $table->string('nama_kelompok', 25)->nullable();
            $table->integer('disc_kel')->nullable();
            $table->decimal('fak_kali_obat', 15)->nullable();
            $table->integer('id_grup')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_nasabah');
    }
};
