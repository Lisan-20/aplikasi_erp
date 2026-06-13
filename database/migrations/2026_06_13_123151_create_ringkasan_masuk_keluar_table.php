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
        if (Schema::hasTable('ringkasan_masuk_keluar')) {
            return;
        }

        Schema::create('ringkasan_masuk_keluar', function (Blueprint $table) {
            $table->increments('id_ringkasan_masuk_keluar');
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('diagnosa_utama', 150)->nullable();
            $table->string('diagnosa_komplikasi', 150)->nullable();
            $table->string('imunisasi', 15)->nullable();
            $table->string('transfusi', 6)->nullable();
            $table->string('imun_rawat', 6)->nullable();
            $table->integer('user_id')->nullable();
            $table->dateTime('tgl_input')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ringkasan_masuk_keluar');
    }
};
