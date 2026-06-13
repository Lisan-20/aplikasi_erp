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
        Schema::create('rm_format_lap_rl_lama', function (Blueprint $table) {
            $table->integer('nomer');
            $table->string('no_urut_dtd', 10)->nullable();
            $table->string('no_dtd', 10)->nullable();
            $table->integer('no_urut_bulan')->nullable();
            $table->string('icd_10')->nullable();
            $table->string('nama_group')->nullable();
            $table->integer('flag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rm_format_lap_rl_lama');
    }
};
