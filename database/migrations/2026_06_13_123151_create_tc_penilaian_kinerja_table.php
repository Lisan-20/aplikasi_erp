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
        Schema::create('tc_penilaian_kinerja', function (Blueprint $table) {
            $table->increments('id_tc_kinerja');
            $table->string('npp', 10)->nullable();
            $table->string('komentar_pegawai', 1000)->nullable();
            $table->string('komentar_penilai', 1000)->nullable();
            $table->string('komentar_atasan', 1000)->nullable();
            $table->string('npp_penilai', 5)->nullable();
            $table->string('npp_atasan', 5)->nullable();
            $table->integer('id_per_penilaian')->nullable();
            $table->integer('kelompok_kinerja')->nullable();
            $table->dateTime('tgl_penilaian')->nullable();
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
        Schema::dropIfExists('tc_penilaian_kinerja');
    }
};
