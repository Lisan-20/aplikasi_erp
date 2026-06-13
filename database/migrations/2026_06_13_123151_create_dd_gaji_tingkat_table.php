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
        if (Schema::hasTable('dd_gaji_tingkat')) {
            return;
        }

        Schema::create('dd_gaji_tingkat', function (Blueprint $table) {
            $table->increments('id_dd_tg');
            $table->string('tg', 5)->nullable();
            $table->dateTime('tgl_berlaku')->nullable();
            $table->dateTime('tgl_berakhir')->nullable();
            $table->string('status_tg', 1)->nullable()->default('0');
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
        Schema::dropIfExists('dd_gaji_tingkat');
    }
};
