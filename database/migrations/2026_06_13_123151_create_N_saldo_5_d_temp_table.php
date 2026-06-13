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
        Schema::create('N_saldo_5_d_temp', function (Blueprint $table) {
            $table->integer('acc_no');
            $table->decimal('debet', 38)->nullable();
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('tx_tipe', 1);
            $table->integer('level_coa');
            $table->string('kode_utama', 1);
            $table->integer('ko_wil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('N_saldo_5_d_temp');
    }
};
