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
        Schema::create('tc_gaji_pokok', function (Blueprint $table) {
            $table->increments('id_tc_gaji_pokok');
            $table->integer('id_mt_periode_gaji')->nullable();
            $table->string('periode_gaji', 50)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('bulan', 3)->nullable();
            $table->string('kelompok', 50)->nullable();
            $table->string('npp', 30)->nullable();
            $table->string('nama_pegawai', 50)->nullable();
            $table->decimal('gaji_pokok', 19, 4)->nullable();
            $table->string('gg', 3)->nullable();
            $table->string('tg', 3)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_gaji_pokok');
    }
};
