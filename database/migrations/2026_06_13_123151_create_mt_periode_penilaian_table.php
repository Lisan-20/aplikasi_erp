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
        Schema::create('mt_periode_penilaian', function (Blueprint $table) {
            $table->increments('id_per_penilaian');
            $table->string('gelombang', 30)->nullable();
            $table->string('tahun', 10)->nullable();
            $table->dateTime('tgl_awal')->nullable();
            $table->dateTime('tgl_akhir')->nullable();
            $table->tinyInteger('status_per_penilaian')->nullable();
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
        Schema::dropIfExists('mt_periode_penilaian');
    }
};
