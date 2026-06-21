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
        if (Schema::hasTable('bd_tc_hutang_dr')) {
            return;
        }

        Schema::create('bd_tc_hutang_dr', function (Blueprint $table) {
            $table->increments('id_bd_tc_hutang_dr');
            $table->string('kode_dokter', 50)->nullable();
            $table->string('no_voucher', 50)->nullable();
            $table->dateTime('tgl_pembentukan')->nullable();
            $table->decimal('nominal', 18, 0)->nullable();
            $table->integer('id_input')->nullable();
            $table->tinyInteger('status_lunas')->nullable();
            $table->dateTime('periode_tgl_awal')->nullable();
            $table->dateTime('periode_tgl_akhir')->nullable();
            $table->decimal('potongan_pajak', 18)->nullable();
            $table->integer('no_sppu')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('flag_ass')->nullable();
            $table->integer('flag_pt')->nullable();
            $table->integer('flag_umum')->nullable();
            $table->integer('flag_jamkesmas')->nullable();
            $table->integer('flag_sktm')->nullable();
            $table->integer('flag_jampersal')->nullable();
            $table->string('no_bukti', 50)->nullable();
            $table->decimal('potongan', 18)->nullable();
            $table->decimal('total_kuitansi', 18)->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->string('rj_ri', 2)->nullable();
            $table->integer('flag_bpjs')->nullable();
            $table->integer('kode_slip')->nullable();
            $table->integer('flag_ver')->nullable();
            $table->integer('flag_op')->nullable();
            $table->integer('flag_bidan')->nullable();
            $table->integer('flag_paramedis')->nullable();
            $table->integer('kode_paramedis')->nullable();
            $table->integer('flag_sitting')->nullable();
            $table->string('id_bd_tc_bayar_dr_kol', 50)->nullable();
            $table->decimal('insentif_dr', 18, 0)->nullable();
            $table->integer('status_gf')->nullable();

            $table->primary(['id_bd_tc_hutang_dr'], 'pk_bd_tc_hutang_dr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_tc_hutang_dr');
    }
};
