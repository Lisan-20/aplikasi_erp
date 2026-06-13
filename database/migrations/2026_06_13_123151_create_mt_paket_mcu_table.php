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
        Schema::create('mt_paket_mcu', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('nama_paket', 50)->nullable();
            $table->integer('kode_grup_tindakan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_paket_mcu');
    }
};
