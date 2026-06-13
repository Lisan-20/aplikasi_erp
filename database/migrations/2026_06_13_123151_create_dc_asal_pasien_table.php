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
        Schema::create('dc_asal_pasien', function (Blueprint $table) {
            $table->increments('id_dc_asal_pasien');
            $table->string('asal_pasien', 100)->nullable();
            $table->integer('flag')->nullable();
            $table->integer('status_aktif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_asal_pasien');
    }
};
