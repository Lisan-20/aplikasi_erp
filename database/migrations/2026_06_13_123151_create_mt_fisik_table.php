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
        Schema::create('mt_fisik', function (Blueprint $table) {
            $table->integer('kode_pemeriksaan');
            $table->string('nama_pemeriksaan', 50)->nullable();
            $table->integer('referensi')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_grup_tindakan')->nullable();
            $table->integer('id_mt_fisik');
            $table->string('no_urut', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_fisik');
    }
};
