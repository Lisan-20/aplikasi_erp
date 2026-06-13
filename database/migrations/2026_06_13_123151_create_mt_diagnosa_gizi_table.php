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
        Schema::create('mt_diagnosa_gizi', function (Blueprint $table) {
            $table->increments('id_diag_gizi');
            $table->text('nama_diagnosa')->nullable();
            $table->integer('lev_diag')->nullable();
            $table->integer('rev')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_diagnosa_gizi');
    }
};
