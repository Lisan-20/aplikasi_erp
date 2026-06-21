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
        if (Schema::hasTable('dd_lembur')) {
            return;
        }

        Schema::create('dd_lembur', function (Blueprint $table) {
            $table->increments('id_dc_lembur');
            $table->string('keterangan', 500)->nullable();
            $table->decimal('nilai', 18)->nullable();
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
        Schema::dropIfExists('dd_lembur');
    }
};
