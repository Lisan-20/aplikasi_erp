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
        Schema::create('fr_mt_lokasi_tebus', function (Blueprint $table) {
            $table->integer('kode_lokasi_tebus');
            $table->string('nama_lokasi', 50)->nullable();

            $table->primary(['kode_lokasi_tebus'], 'pk_fr_lokasi_tebus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_mt_lokasi_tebus');
    }
};
