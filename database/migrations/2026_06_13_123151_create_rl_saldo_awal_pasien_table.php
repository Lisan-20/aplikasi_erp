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
        if (Schema::hasTable('rl_saldo_awal_pasien')) {
            return;
        }

        Schema::create('rl_saldo_awal_pasien', function (Blueprint $table) {
            $table->increments('kd_saldo');
            $table->char('kode_pelayanan', 10)->nullable();
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('saldo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rl_saldo_awal_pasien');
    }
};
