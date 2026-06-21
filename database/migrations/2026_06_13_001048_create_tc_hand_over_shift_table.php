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
        if (Schema::hasTable('tc_hand_over_shift')) {
            return;
        }

        Schema::create('tc_hand_over_shift', function (Blueprint $table) {
            $table->increments('no_urut_over');
            $table->integer('kode_shift')->nullable();
            $table->integer('no_induk_kirim')->nullable();
            $table->integer('no_induk_terima')->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->integer('kode_dokter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_hand_over_shift');
    }
};
