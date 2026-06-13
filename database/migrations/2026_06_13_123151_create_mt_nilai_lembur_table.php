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
        Schema::create('mt_nilai_lembur', function (Blueprint $table) {
            $table->integer('id_mt_nilai_lembur')->nullable();
            $table->integer('flag_medis')->nullable();
            $table->decimal('nilai', 19, 4)->nullable();
            $table->integer('user_edit')->nullable();
            $table->dateTime('tgl_edit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_nilai_lembur');
    }
};
