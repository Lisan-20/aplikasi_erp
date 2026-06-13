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
        if (Schema::hasTable('tc_kuitansi_gabung')) {
            return;
        }

        Schema::create('tc_kuitansi_gabung', function (Blueprint $table) {
            $table->increments('kode_kuitansi');
            $table->integer('no_kui_gabung')->nullable();
            $table->dateTime('tgl_jam')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kuitansi_gabung');
    }
};
