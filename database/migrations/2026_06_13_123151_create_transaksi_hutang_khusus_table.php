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
        Schema::create('transaksi_hutang_khusus', function (Blueprint $table) {
            $table->increments('id_trans_hutang');
            $table->string('acc_no_1', 50);
            $table->string('acc_no_2', 50)->nullable();
            $table->tinyInteger('tx_tipe')->nullable();
            $table->decimal('jumlah_transaksi', 18)->nullable();
            $table->integer('kode_bank')->nullable();
            $table->string('no_giro', 50)->nullable();
            $table->dateTime('tgl_bank')->nullable();
            $table->string('no_bukti', 50);
            $table->dateTime('tgl_transaksi')->nullable();
            $table->integer('flag_jurnal')->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('inp_tgl')->nullable();
            $table->integer('inp_id')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->tinyInteger('status_lunas')->nullable();
            $table->integer('stat_id')->nullable();
            $table->dateTime('tgl_bayar')->nullable();
            $table->integer('status_bayar')->nullable();
            $table->integer('flag_ver')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('flag_tmp')->nullable();
            $table->integer('flag_modul')->nullable();
            $table->decimal('jumlah_ppn', 19, 4)->nullable();
            $table->decimal('jumlah_pph', 19, 4)->nullable();
            $table->decimal('total', 19, 4)->nullable();
            $table->integer('id_bd_tc_trans')->nullable();
            $table->decimal('diskon', 19, 4)->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('ko_wil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_hutang_khusus');
    }
};
