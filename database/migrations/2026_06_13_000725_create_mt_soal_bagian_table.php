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
        if (Schema::hasTable('mt_soal_bagian')) {
            return;
        }

        Schema::create('mt_soal_bagian', function (Blueprint $table) {
            $table->increments('id_soal');
            $table->integer('id_mt_soal')->nullable();
            $table->integer('kode_bagian_x')->nullable();
            $table->string('kode_bagian', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_soal_bagian');
    }
};
