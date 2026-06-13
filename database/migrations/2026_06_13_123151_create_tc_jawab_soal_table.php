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
        Schema::create('tc_jawab_soal', function (Blueprint $table) {
            $table->increments('id_jawab');
            $table->integer('no_peserta')->nullable();
            $table->integer('id_mt_soal')->nullable();
            $table->text('jawaban')->nullable();
            $table->integer('id_mt_bank_soal_det')->nullable();
            $table->integer('id_tipe')->nullable();
            $table->integer('no_urut')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_jawab_soal');
    }
};
