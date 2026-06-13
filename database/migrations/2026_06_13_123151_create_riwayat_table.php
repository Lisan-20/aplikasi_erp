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
        Schema::create('riwayat', function (Blueprint $table) {
            $table->string('NOKARCIS', 24)->nullable();
            $table->string('MEDREC', 18)->nullable();
            $table->dateTime('TANGGAL')->nullable();
            $table->string('PERIKSA', 105)->nullable();
            $table->string('PERIKSA2', 105)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat');
    }
};
