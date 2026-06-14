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
        if (Schema::hasTable('mapping_jenis_proses')) {
            return;
        }

        Schema::create('mapping_jenis_proses', function (Blueprint $table) {
            $table->integer('kode_jenis_proses');
            $table->string('nama_jenis_proses', 50)->nullable();
            $table->integer('kode_proses')->nullable();
            $table->integer('kode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapping_jenis_proses');
    }
};
