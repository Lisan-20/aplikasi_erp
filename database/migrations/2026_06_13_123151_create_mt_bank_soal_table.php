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
        Schema::create('mt_bank_soal', function (Blueprint $table) {
            $table->increments('id_mt_soal');
            $table->text('soal')->nullable();
            $table->integer('id_tipe')->nullable();
            $table->text('jawaban')->nullable();
            $table->text('kategori_soal')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('no_urut2', 3)->nullable();
            $table->integer('no_urut')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_bank_soal');
    }
};
