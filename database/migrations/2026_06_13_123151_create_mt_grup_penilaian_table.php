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
        Schema::create('mt_grup_penilaian', function (Blueprint $table) {
            $table->increments('id_grup_penilaian');
            $table->integer('grup_penilaian')->nullable();
            $table->text('nama_grup')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_grup_penilaian');
    }
};
