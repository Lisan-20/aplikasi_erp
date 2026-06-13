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
        Schema::create('bd_tc_bayar_dr', function (Blueprint $table) {
            $table->increments('id_bd_tc_bayar_dr');
            $table->integer('id_bd_tc_hutang_dr')->nullable();
            $table->string('no_voucher', 50)->nullable();
            $table->string('kode_dokter', 20)->nullable();
            $table->decimal('nominal_bayar', 18)->nullable();
            $table->dateTime('tgl_bayar')->nullable();
            $table->decimal('pajak_dr', 18)->nullable();
            $table->decimal('potongan_rs', 18)->nullable();
            $table->decimal('biaya_materai', 18, 0)->nullable();
            $table->string('no_kutansi_byr_old', 20)->nullable();
            $table->string('no_kutansi_byr', 50)->nullable();
            $table->integer('id_bd_tc_trans')->nullable();
            $table->string('no_voucher_kol', 50)->nullable();
            $table->string('id_bd_tc_hutang_dr_kol', 50)->nullable();
            $table->string('kode_paramedis', 20)->nullable();

            $table->primary(['id_bd_tc_bayar_dr'], 'pk_bd_tc_bayar_dr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_tc_bayar_dr');
    }
};
