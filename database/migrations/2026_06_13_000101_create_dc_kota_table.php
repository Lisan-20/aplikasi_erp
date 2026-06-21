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
        if (Schema::hasTable('dc_kota')) {
            return;
        }

        Schema::create('dc_kota', function (Blueprint $table) {
            $table->increments('id_dc_kota');
            $table->string('inisial_kota', 5)->nullable();
            $table->string('nama_kota', 50)->nullable();
            $table->integer('id_dc_propinsi')->nullable();
            $table->integer('id_dc_negara')->nullable();

            $table->primary(['id_dc_kota'], 'pk_dc_kota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_kota');
    }
};
