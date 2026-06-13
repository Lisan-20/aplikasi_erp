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
        Schema::create('th_pernyataan_setuju', function (Blueprint $table) {
            $table->increments('id_pernyataan_setuju');
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('nama_wali', 50)->nullable();
            $table->string('umur', 3)->nullable();
            $table->string('jen_kel', 1)->nullable();
            $table->string('no_mr_wali', 8)->nullable();
            $table->string('terhadap', 25)->nullable();
            $table->string('nama_tindakan', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_user')->nullable();
            $table->string('alamat_wali', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_pernyataan_setuju');
    }
};
