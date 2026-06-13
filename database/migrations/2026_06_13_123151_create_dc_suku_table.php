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
        Schema::create('dc_suku', function (Blueprint $table) {
            $table->increments('id_dc_suku');
            $table->string('suku', 50)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->smallInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();

            $table->primary(['id_dc_suku'], 'pk_hrdd_suku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_suku');
    }
};
