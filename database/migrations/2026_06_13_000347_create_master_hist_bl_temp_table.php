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
        if (Schema::hasTable('master_hist_bl_temp')) {
            return;
        }

        Schema::create('master_hist_bl_temp', function (Blueprint $table) {
            $table->increments('no_hist_bl');
            $table->integer('acc_no')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('bulan')->nullable();
            $table->decimal('mutasi_d', 18)->nullable();
            $table->decimal('mutasi_k', 18)->nullable();
            $table->decimal('saldo_awal', 18)->nullable();
            $table->decimal('saldo_akhir', 18)->nullable();
            $table->string('level', 50)->nullable();
            $table->integer('flag')->nullable();
            $table->string('acc_type', 10)->nullable();
            $table->string('tx_tipe', 10)->nullable();
            $table->integer('tgl')->nullable();
            $table->integer('ko_wil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_hist_bl_temp');
    }
};
