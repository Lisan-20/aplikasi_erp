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
        Schema::create('tc_jasa', function (Blueprint $table) {
            $table->increments('id_tc_jasa');
            $table->string('npp', 6)->nullable();
            $table->string('penghargaan', 100)->nullable();
            $table->dateTime('tgl_jasa')->nullable();
            $table->string('lembaga', 100)->nullable();
            $table->string('no_piagam', 50)->nullable();
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
        Schema::dropIfExists('tc_jasa');
    }
};
