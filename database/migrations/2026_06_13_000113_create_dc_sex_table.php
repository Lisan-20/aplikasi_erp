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
        if (Schema::hasTable('dc_sex')) {
            return;
        }

        Schema::create('dc_sex', function (Blueprint $table) {
            $table->increments('id_dc_sex');
            $table->string('sex', 2)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();

            $table->primary(['id_dc_sex'], 'pk__hrdd_sex__7db89c09');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_sex');
    }
};
