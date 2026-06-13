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
        Schema::create('th_periode_penilaian', function (Blueprint $table) {
            $table->increments('id_th');
            $table->integer('id_pertanyaan')->nullable();
            $table->decimal('jawaban1', 18, 0)->nullable();
            $table->decimal('jawaban2', 18, 0)->nullable();
            $table->decimal('jawaban3', 18, 0)->nullable();
            $table->decimal('jawaban4', 18, 0)->nullable();
            $table->decimal('jawaban5', 18, 0)->nullable();
            $table->integer('id_periode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_periode_penilaian');
    }
};
