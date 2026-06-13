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
        Schema::create('mt_administrasi', function (Blueprint $table) {
            $table->increments('id_mt_administrasi');
            $table->decimal('persen', 19, 4)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->integer('user_input')->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->integer('kategori')->nullable();
            $table->decimal('administrasi', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_administrasi');
    }
};
