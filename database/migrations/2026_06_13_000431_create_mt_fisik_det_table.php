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
        if (Schema::hasTable('mt_fisik_det')) {
            return;
        }

        Schema::create('mt_fisik_det', function (Blueprint $table) {
            $table->integer('id_mt_fisik_det');
            $table->integer('kode_pemeriksaan')->nullable();
            $table->string('pemeriksaan_detail', 50)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_grup_tindakan')->nullable();
            $table->integer('id_mt_tindakan_fisik')->nullable();
            $table->integer('no_urut_det')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_fisik_det');
    }
};
