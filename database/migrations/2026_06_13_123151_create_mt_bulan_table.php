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
        Schema::create('mt_bulan', function (Blueprint $table) {
            $table->increments('id_mt_bulan');
            $table->integer('bulan')->nullable();
            $table->integer('jumlah_hari')->nullable();
            $table->char('triwulan', 10)->nullable();
            $table->char('semester', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_bulan');
    }
};
