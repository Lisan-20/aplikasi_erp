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
        Schema::create('tx_harian', function (Blueprint $table) {
            $table->increments('no_urut');
            $table->integer('acc_no');
            $table->decimal('tx_nominal', 18);
            $table->string('tx_uraian')->nullable();
            $table->dateTime('tx_tgl');
            $table->dateTime('tx_jam');
            $table->string('tx_tipe', 1);
            $table->integer('no_jurnal')->nullable();
            $table->integer('no_det_jurnal')->nullable();
            $table->string('no_bukti');
            $table->string('kode_bagian', 18)->nullable();
            $table->string('no_induk', 20)->nullable();
            $table->string('kel_jurnal', 50);
            $table->string('no_mr', 50)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kode_tc_trans_kasir')->nullable();
            $table->integer('kode_supplier')->nullable();
            $table->integer('kode_dr_int')->nullable();
            $table->string('kode_barang', 50)->nullable();
            $table->integer('kode_bank')->nullable();
            $table->string('referensi', 50)->nullable();
            $table->integer('flag_k')->nullable();
            $table->integer('flag_posting')->nullable();
            $table->integer('kd_trans_bendahara')->nullable();
            $table->integer('kd_group_trans')->nullable();
            $table->integer('flag_realisasi')->nullable();
            $table->decimal('jumlah_barang', 18)->nullable();
            $table->integer('flag_rekon')->nullable();
            $table->integer('user_rekon')->nullable();
            $table->integer('id_rekon')->nullable();
            $table->integer('flag_balik_rj')->nullable();
            $table->string('kode_rekon', 50)->nullable();
            $table->dateTime('tgl_bank')->nullable();
            $table->integer('id_pajak')->nullable();
            $table->integer('flag_pajak')->nullable();
            $table->integer('flag_b')->nullable();
            $table->integer('flag_cogs')->nullable();
            $table->dateTime('tgl_tempo')->nullable();
            $table->integer('kode_trans_far')->nullable();
            $table->integer('kd_tr_resep')->nullable();
            $table->integer('ko_wil')->nullable();
            $table->dateTime('tgl_srt_piutang')->nullable();
            $table->bigInteger('kode_ri')->nullable();
            $table->integer('kode_inap')->nullable();
            $table->string('kode_dr', 20)->nullable();
            $table->string('kode_bagian_asal', 18)->nullable();
            $table->string('ket_rekon', 50)->nullable();
            $table->integer('flag_rekon_all')->nullable();
            $table->integer('flag_gizi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tx_harian');
    }
};
