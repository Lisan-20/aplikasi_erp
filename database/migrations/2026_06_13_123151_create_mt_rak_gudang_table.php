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
        Schema::create('mt_rak_gudang', function (Blueprint $table) {
            $table->increments('id_mt_rak');
            $table->string('nama_rak', 50)->nullable();
            $table->string('keterangan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_rak_gudang');
    }
};
