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
        if (Schema::hasTable('tc_pemeliharaan_alat')) {
            return;
        }

        Schema::create('tc_pemeliharaan_alat', function (Blueprint $table) {
            $table->increments('id_pemeliharaan');
            $table->integer('kode_depo_stok_nm')->nullable();
            $table->dateTime('tgl_pemeliharaan')->nullable();
            $table->text('keluhan')->nullable();
            $table->text('solusi')->nullable();
            $table->text('catatan')->nullable();
            $table->dateTime('tgl_rencana')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemeliharaan_alat');
    }
};
