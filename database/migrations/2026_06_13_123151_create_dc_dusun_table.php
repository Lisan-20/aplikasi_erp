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
        if (Schema::hasTable('dc_dusun')) {
            return;
        }

        Schema::create('dc_dusun', function (Blueprint $table) {
            $table->increments('id_dc_dusun');
            $table->integer('id_dc_kelurahan');
            $table->string('inisial_dusun', 50)->nullable();
            $table->string('nama_dusun', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_dusun');
    }
};
