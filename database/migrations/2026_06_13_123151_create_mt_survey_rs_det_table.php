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
        Schema::create('mt_survey_rs_det', function (Blueprint $table) {
            $table->increments('id_pertanyaan_det2');
            $table->integer('id_pertanyaan')->nullable();
            $table->text('jawaban')->nullable();
            $table->text('id_pertanyaan_det')->nullable();
            $table->integer('id_jawaban')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_survey_rs_det');
    }
};
