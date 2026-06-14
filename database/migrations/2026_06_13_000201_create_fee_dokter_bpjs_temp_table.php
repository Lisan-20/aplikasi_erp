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
        if (Schema::hasTable('fee_dokter_bpjs_temp')) {
            return;
        }

        Schema::create('fee_dokter_bpjs_temp', function (Blueprint $table) {
            $table->increments('id_fee_dr_bpjs_temp');
            $table->integer('kode_dr')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 10)->nullable();
            $table->string('seri_kuitansi', 2)->nullable();
            $table->integer('no_kuitansi')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->dateTime('tgl_kuitansi')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->string('nama_tindakan')->nullable();
            $table->bigInteger('kode_trans_pelayanan')->nullable();
            $table->integer('no_sppu')->nullable();
            $table->integer('flag_sppu')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kode_tc_trans_kasir')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->integer('no_induk')->nullable();
            $table->integer('id_tc_fee_dokter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_dokter_bpjs_temp');
    }
};
