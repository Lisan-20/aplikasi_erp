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
        Schema::create('standarhasil_lab', function (Blueprint $table) {
            $table->string('kode', 5)->nullable();
            $table->string('nama_paket', 150)->nullable();
            $table->string('jenis', 1)->nullable();
            $table->string('kode_detail', 5)->nullable();
            $table->string('nama', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standarhasil_lab');
    }
};
