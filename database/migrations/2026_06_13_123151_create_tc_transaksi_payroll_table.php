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
        Schema::create('tc_transaksi_payroll', function (Blueprint $table) {
            $table->increments('id_tc_trans');
            $table->string('npp_old', 10)->nullable();
            $table->integer('id_kd_transaksi_det')->nullable();
            $table->decimal('nominal', 19, 4)->nullable();
            $table->string('uraian_transaksi', 50)->nullable();
            $table->dateTime('tgl_mulai')->nullable();
            $table->dateTime('tgl_akhir')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_user')->nullable();
            $table->char('id_kd_transaksi', 10)->nullable();
            $table->integer('status')->nullable();
            $table->integer('bln_gaji')->nullable();
            $table->integer('thn_gaji')->nullable();
            $table->decimal('Nilai', 18)->nullable();
            $table->integer('flag_konstant')->nullable();
            $table->string('npp', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_transaksi_payroll');
    }
};
