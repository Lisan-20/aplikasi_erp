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
        Schema::create('dc_modular', function (Blueprint $table) {
            $table->integer('id_dc_modular');
            $table->string('nama_modular', 50)->nullable();
            $table->integer('no_urut_modular')->nullable();
            $table->integer('kd_modular')->nullable();

            $table->primary(['id_dc_modular'], 'pk_dc_modular');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_modular');
    }
};
