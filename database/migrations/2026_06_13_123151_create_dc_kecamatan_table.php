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
        Schema::create('dc_kecamatan', function (Blueprint $table) {
            $table->increments('id_dc_kecamatan');
            $table->integer('id_dc_kota')->nullable();
            $table->string('inisial_kecamatan', 10)->nullable();
            $table->string('nama_kecamatan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_kecamatan');
    }
};
