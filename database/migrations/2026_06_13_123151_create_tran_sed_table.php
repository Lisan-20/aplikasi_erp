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
        Schema::create('tran_sed', function (Blueprint $table) {
            $table->increments('kode_trans_sed');
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('seri_kuitansi', 4)->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('jenis_tindakan')->nullable();
            $table->integer('acc_no')->nullable();
            $table->string('tipe', 2)->nullable();
            $table->integer('kode')->nullable();
            $table->integer('kode_tc_trans_kasir')->nullable();
            $table->string('kode_barang', 50)->nullable();
            $table->string('nama_tindakan')->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->dateTime('tgl_proses')->nullable();
            $table->integer('kode_dr_int')->nullable();
            $table->integer('kode_trans_far')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->string('kode_bagian_asal', 10)->nullable();
            $table->integer('kode_trans_pelayanan')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kode_tarif')->nullable();
            $table->integer('flag_jurnal')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('kd_tr_resep')->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->decimal('vol', 18)->nullable();
            $table->decimal('tx_nominal', 18)->nullable();
            $table->integer('id_jenis_layanan')->nullable();
            $table->integer('kode_inap')->nullable();
            $table->bigInteger('no_kuitansi')->nullable();
            $table->string('kode_dr', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tran_sed');
    }
};
