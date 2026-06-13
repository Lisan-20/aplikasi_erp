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
        Schema::create('saldo_awal_bulanan', function (Blueprint $table) {
            $table->integer('no_saldo_bln');
            $table->integer('acc_no')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('bulan')->nullable();
            $table->decimal('saldo_awal', 18)->nullable();
            $table->string('level', 50)->nullable();
            $table->integer('flag')->nullable();
            $table->string('acc_type', 10)->nullable();
            $table->string('tx_tipe', 10)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('kode_bagian', 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_awal_bulanan');
    }
};
