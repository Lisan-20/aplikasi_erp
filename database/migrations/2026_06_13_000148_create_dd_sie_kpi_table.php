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
        if (Schema::hasTable('dd_sie_kpi')) {
            return;
        }

        Schema::create('dd_sie_kpi', function (Blueprint $table) {
            $table->increments('id_kpi');
            $table->integer('id_group')->nullable();
            $table->integer('id_goup_sasaran')->nullable();
            $table->string('nama_kpi', 50)->nullable();
            $table->string('keterangan_kpi')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->integer('status')->nullable();
            $table->string('satuan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_sie_kpi');
    }
};
