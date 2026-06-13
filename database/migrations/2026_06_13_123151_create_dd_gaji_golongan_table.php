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
        Schema::create('dd_gaji_golongan', function (Blueprint $table) {
            $table->increments('id_dd_gg');
            $table->string('gg', 5)->nullable();
            $table->dateTime('tgl_berlaku')->nullable();
            $table->dateTime('tgl_berakhir')->nullable();
            $table->string('status_gg', 1)->nullable()->default('0');
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->smallInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->string('kode_lama', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_gaji_golongan');
    }
};
