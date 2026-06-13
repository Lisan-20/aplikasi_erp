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
        Schema::create('mt_diskon_flat_perusahaan', function (Blueprint $table) {
            $table->increments('kode_pola');
            $table->integer('kode_perusahaan')->nullable();
            $table->float('diskon_kamar', 53, 0)->nullable();
            $table->float('diskon_ri', 53, 0)->nullable();
            $table->float('diskon_rj', 53, 0)->nullable();
            $table->float('tarif_kamar', 53, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_diskon_flat_perusahaan');
    }
};
