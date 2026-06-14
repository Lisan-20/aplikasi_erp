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
        if (Schema::hasTable('dd_sie_sasaran')) {
            return;
        }

        Schema::create('dd_sie_sasaran', function (Blueprint $table) {
            $table->increments('id_goup_sasaran');
            $table->integer('id_group')->nullable();
            $table->string('nama_sasaran', 50)->nullable();
            $table->string('keterangan_group')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->integer('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_sie_sasaran');
    }
};
