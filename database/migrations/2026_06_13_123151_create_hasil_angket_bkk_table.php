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
        Schema::create('hasil_angket_bkk', function (Blueprint $table) {
            $table->integer('id_jawaban')->nullable();
            $table->integer('id_pertanyaan')->nullable();
            $table->string('bagian', 50)->nullable();
            $table->text('komentar')->nullable();
            $table->integer('id_pertanyaan_det2')->nullable();
            $table->increments('id');
            $table->text('id_pertanyaan_det')->nullable();
            $table->text('nama_pegawai')->nullable();
            $table->text('nama_pegawai1')->nullable();
            $table->integer('id_periode_survey')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_angket_bkk');
    }
};
