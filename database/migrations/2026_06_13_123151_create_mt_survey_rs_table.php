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
        if (Schema::hasTable('mt_survey_rs')) {
            return;
        }

        Schema::create('mt_survey_rs', function (Blueprint $table) {
            $table->increments('id_pertanyaan');
            $table->integer('kode_kelompok')->nullable();
            $table->text('pertanyaan')->nullable();
            $table->integer('no_urut')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_survey_rs');
    }
};
