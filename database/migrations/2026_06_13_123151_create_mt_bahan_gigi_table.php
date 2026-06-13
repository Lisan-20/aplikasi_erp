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
        Schema::create('mt_bahan_gigi', function (Blueprint $table) {
            $table->increments('id_bahan');
            $table->string('singkatan_bahan', 4)->nullable();
            $table->string('arti_bahan', 50)->nullable();
            $table->string('keterangan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_bahan_gigi');
    }
};
