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
        Schema::create('transaksi_umd', function (Blueprint $table) {
            $table->integer('id_trans_umd');
            $table->string('acc_no_1', 50);
            $table->string('acc_no_2', 50)->nullable();
            $table->tinyInteger('tx_tipe')->nullable();
            $table->decimal('jumlah_transaksi', 19, 4);
            $table->string('no_bukti', 50);
            $table->dateTime('tgl_transaksi');
            $table->integer('flag_jurnal');
            $table->string('keterangan')->nullable();
            $table->dateTime('inp_tgl');
            $table->integer('inp_id')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_supplier')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('referensi', 50)->nullable();
            $table->integer('kode_dr')->nullable();
            $table->tinyInteger('stat');
            $table->integer('stat_id')->nullable();
            $table->dateTime('tgl_eod')->nullable();
            $table->integer('flag_ver')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->dateTime('tgl_tempo')->nullable();
            $table->decimal('jumlah_ppn', 19, 4)->nullable();
            $table->decimal('jumlah_pph', 19, 4)->nullable();
            $table->decimal('total', 19, 4)->nullable();
            $table->string('status_bayar', 50)->nullable();
            $table->dateTime('tgl_bayar')->nullable();
            $table->integer('stat_ver')->nullable();
            $table->integer('minggu')->nullable();
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('no_urut')->nullable();
            $table->decimal('jumlah_pengajuan', 19, 4)->nullable();
            $table->integer('flag_is')->nullable();

            $table->primary(['id_trans_umd'], 'pk_transaksi_umd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_umd');
    }
};
