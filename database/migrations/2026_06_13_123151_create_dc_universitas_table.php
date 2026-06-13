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
        if (Schema::hasTable('dc_universitas')) {
            return;
        }

        Schema::create('dc_universitas', function (Blueprint $table) {
            $table->increments('id_dd_universitas');
            $table->string('universitas', 50)->nullable();
            $table->string('singkatan', 50)->nullable();
            $table->integer('id_dc_kota')->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_universitas');
    }
};
