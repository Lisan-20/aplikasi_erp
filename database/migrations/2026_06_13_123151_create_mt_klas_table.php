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
        Schema::create('mt_klas', function (Blueprint $table) {
            $table->integer('kode_klas');
            $table->string('nama_klas', 50)->nullable();
            $table->string('kode_klas_bpjs', 10)->nullable();
            $table->integer('tingkat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_klas');
    }
};
