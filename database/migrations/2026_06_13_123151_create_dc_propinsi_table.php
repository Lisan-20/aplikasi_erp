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
        Schema::create('dc_propinsi', function (Blueprint $table) {
            $table->increments('id_dc_propinsi');
            $table->string('inisial_propinsi', 10)->nullable();
            $table->string('nama_propinsi', 50)->nullable();
            $table->integer('id_dc_negara')->nullable();
            $table->integer('kode_propinsi')->nullable();

            $table->primary(['id_dc_propinsi'], 'pk_dc_propinsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_propinsi');
    }
};
