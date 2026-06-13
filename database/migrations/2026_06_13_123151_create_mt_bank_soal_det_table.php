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
        Schema::create('mt_bank_soal_det', function (Blueprint $table) {
            $table->increments('id_mt_bank_soal_det');
            $table->integer('id_mt_soal')->nullable();
            $table->text('detail_soal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_bank_soal_det');
    }
};
