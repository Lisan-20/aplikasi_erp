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
        if (Schema::hasTable('fr_tc_far_his_temp')) {
            return;
        }

        Schema::create('fr_tc_far_his_temp', function (Blueprint $table) {
            $table->integer('kode_trans_far')->nullable();
            $table->dateTime('tgl_trans')->nullable();
            $table->integer('kd_tr_resep')->nullable();
            $table->string('nama_brg', 250)->nullable();
            $table->string('kode_brg', 250)->nullable();
            $table->decimal('jumlah_pesan', 19, 4)->nullable();
            $table->decimal('jumlah_tebus', 19, 4)->nullable();
            $table->decimal('sisa', 19, 4)->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->decimal('harga_jual', 19, 4)->nullable();
            $table->decimal('harga_r', 19, 4)->nullable();
            $table->integer('status_kirim')->nullable();
            $table->integer('kode_profit')->nullable();
            $table->integer('status_transaksi')->nullable();
            $table->string('no_mr', 20)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('kode_bagian_asal', 50)->nullable();
            $table->integer('kode_pesan_resep')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('dokter_pengirim', 250)->nullable();
            $table->string('nama_pasien', 250)->nullable();
            $table->string('alamat_pasien', 250)->nullable();
            $table->string('telpon_pasien', 250)->nullable();
            $table->string('no_resep', 50)->nullable();
            $table->decimal('jumlah_retur', 19, 4)->nullable();
            $table->decimal('harga_r_retur', 19, 4)->nullable();
            $table->integer('status_retur')->nullable();
            $table->decimal('biaya_tebus', 19, 4)->nullable();
            $table->integer('racik')->nullable();
            $table->string('satuan_kecil', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_tc_far_his_temp');
    }
};
