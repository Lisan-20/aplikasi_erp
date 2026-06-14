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
        if (Schema::hasTable('dd_jam_absen')) {
            return;
        }

        Schema::create('dd_jam_absen', function (Blueprint $table) {
            $table->increments('id_dd_jam_absen');
            $table->dateTime('jam_absen_masuk')->nullable();
            $table->dateTime('jam_absen_pulang')->nullable();
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
        Schema::dropIfExists('dd_jam_absen');
    }
};
