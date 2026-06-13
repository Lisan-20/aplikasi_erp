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
        Schema::create('info_ruangan', function (Blueprint $table) {
            $table->string('kode_bagian', 50)->nullable();
            $table->string('nama_bagian', 250)->nullable();
            $table->string('nama_klas', 50)->nullable();
            $table->string('no_kamar', 50)->nullable();
            $table->string('no_bed', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->integer('kode_klas')->nullable();
            $table->integer('urutan')->nullable();
            $table->dateTime('tgl_update')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_ruangan');
    }
};
