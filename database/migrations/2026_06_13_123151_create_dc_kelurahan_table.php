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
        Schema::create('dc_kelurahan', function (Blueprint $table) {
            $table->increments('id_dc_kelurahan');
            $table->integer('id_dc_kecamatan')->nullable();
            $table->string('inisial_kelurahan', 10)->nullable();
            $table->string('nama_kelurahan', 50)->nullable();
            $table->integer('kode_pos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_kelurahan');
    }
};
