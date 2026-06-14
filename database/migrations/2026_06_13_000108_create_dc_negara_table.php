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
        if (Schema::hasTable('dc_negara')) {
            return;
        }

        Schema::create('dc_negara', function (Blueprint $table) {
            $table->increments('id_dc_negara');
            $table->string('inisial_negara', 5)->nullable();
            $table->string('nama_negara', 50)->nullable();

            $table->primary(['id_dc_negara'], 'pk_dc_negara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_negara');
    }
};
