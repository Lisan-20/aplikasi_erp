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
        Schema::create('dc_sub_asal_pasien', function (Blueprint $table) {
            $table->increments('id_dc_sub_asal_pasien');
            $table->integer('id_dc_asal_pasien')->nullable();
            $table->string('detail', 250)->nullable();
            $table->string('alamat', 250)->nullable();
            $table->string('no_telp', 50)->nullable();
            $table->integer('status_aktif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_sub_asal_pasien');
    }
};
