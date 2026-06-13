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
        Schema::create('mt_klas_detail', function (Blueprint $table) {
            $table->integer('kode_klas_det')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->string('nama_klas_detail', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_klas_detail');
    }
};
