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
        if (Schema::hasTable('mt_kelompok_antrian')) {
            return;
        }

        Schema::create('mt_kelompok_antrian', function (Blueprint $table) {
            $table->increments('id_kel_antrian');
            $table->string('kel_antrian', 50)->nullable();
            $table->string('icon', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kelompok_antrian');
    }
};
