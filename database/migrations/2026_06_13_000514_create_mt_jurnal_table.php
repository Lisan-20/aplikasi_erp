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
        if (Schema::hasTable('mt_jurnal')) {
            return;
        }

        Schema::create('mt_jurnal', function (Blueprint $table) {
            $table->increments('id_mt_jurnal');
            $table->integer('acc_no')->nullable();
            $table->decimal('tx_nominal', 18)->nullable();
            $table->string('tx_uraian')->nullable();
            $table->dateTime('tx_tgl')->nullable();
            $table->string('tx_tipe', 1)->nullable();
            $table->integer('no_jurnal')->nullable();
            $table->integer('no_det_jurnal')->nullable();
            $table->string('no_bukti')->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('kd_tipe_bayar')->nullable();
            $table->string('no_induk', 20)->nullable();
            $table->integer('posting')->nullable();
            $table->integer('kode_tbl_trans')->nullable();
            $table->integer('jenis_tbl_trans')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('kode_proses')->nullable();
            $table->integer('kode_jenis_proses')->nullable();
            $table->integer('kode_komponen')->nullable();
            $table->integer('no_kuitansi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('tx_no_mr', 6)->nullable();
            $table->integer('tx_jenis_proses')->nullable();
            $table->integer('id_ak_tc_transaksi_det')->nullable();

            $table->primary(['id_mt_jurnal'], 'pk_mt_jurnal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_jurnal');
    }
};
