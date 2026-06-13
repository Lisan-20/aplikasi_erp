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
        Schema::create('dc_pendidikan', function (Blueprint $table) {
            $table->increments('id_dc_pendidikan');
            $table->string('pendidikan', 250)->nullable();
            $table->integer('kd_grup_kualifikasi')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();

            $table->primary(['id_dc_pendidikan'], 'pk_dc_pendidikan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_pendidikan');
    }
};
