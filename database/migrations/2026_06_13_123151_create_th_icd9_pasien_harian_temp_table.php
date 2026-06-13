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
        Schema::create('th_icd9_pasien_harian_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nama_icd9')->nullable();
            $table->string('kode_icd9', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->dateTime('tgl_jam')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_icd9_pasien_harian_temp');
    }
};
