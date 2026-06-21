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
        if (Schema::hasTable('tc_layanan_antrian')) {
            return;
        }

        Schema::create('tc_layanan_antrian', function (Blueprint $table) {
            $table->integer('kode');
            $table->string('kode_layanan', 50)->nullable();
            $table->string('nama_layanan', 50)->nullable();
            $table->string('status_aktif', 1)->nullable();
            $table->integer('urutan')->nullable();
            $table->string('sound', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_layanan_antrian');
    }
};
