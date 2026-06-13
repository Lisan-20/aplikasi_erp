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
        Schema::create('tc_slip_sppu_dokter', function (Blueprint $table) {
            $table->integer('kode_slip');
            $table->string('no_slip', 50)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->decimal('bruto', 18)->nullable();
            $table->decimal('potongan', 18)->nullable();
            $table->decimal('pot_pajak', 18)->nullable();
            $table->decimal('net_fee', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_slip_sppu_dokter');
    }
};
