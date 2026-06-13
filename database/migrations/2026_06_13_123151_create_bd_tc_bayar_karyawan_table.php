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
        Schema::create('bd_tc_bayar_karyawan', function (Blueprint $table) {
            $table->increments('id_bd_tc_bayar_gaji');
            $table->string('no_voucher', 50)->nullable();
            $table->string('no_induk', 20)->nullable();
            $table->decimal('nominal_bayar', 18)->nullable();
            $table->dateTime('tgl_bayar')->nullable();
            $table->decimal('pajak_karyawan', 18)->nullable();
            $table->string('no_kutansi_byr', 50)->nullable();
            $table->integer('id_periode_gaji')->nullable();
            $table->integer('id_bd_tc_trans')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_tc_bayar_karyawan');
    }
};
