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
        if (Schema::hasTable('mt_periode_survey')) {
            return;
        }

        Schema::create('mt_periode_survey', function (Blueprint $table) {
            $table->increments('id_periode_survey');
            $table->string('periode_survey', 20)->nullable();
            $table->dateTime('periode_awal')->nullable();
            $table->dateTime('periode_akhir')->nullable();
            $table->string('periode_ket', 50)->nullable();
            $table->string('status_periode_survey', 1)->nullable()->default('0');
            $table->string('status_periode_honor', 1)->nullable()->default('0');
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->integer('status_bayar')->nullable();
            $table->integer('flag_final')->nullable();
            $table->dateTime('tgl_final')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('status_survey')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_periode_survey');
    }
};
