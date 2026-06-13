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
        if (Schema::hasTable('tc_fee_dokter_bpjs')) {
            return;
        }

        Schema::create('tc_fee_dokter_bpjs', function (Blueprint $table) {
            $table->increments('id_tc_fee_dokter');
            $table->integer('kode_dr')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('seri_kuitansi', 2)->nullable();
            $table->integer('no_kuitansi')->nullable();
            $table->string('nama_pasien', 50)->nullable();
            $table->decimal('fee_dokter', 18)->nullable();
            $table->string('nama_tindakan')->nullable();
            $table->integer('kode_plafon')->nullable();
            $table->decimal('persen_dr', 18)->nullable();
            $table->decimal('plafon_bpjs', 18)->nullable();
            $table->integer('jumlah_dokter')->nullable();
            $table->decimal('persen', 18)->nullable();
            $table->integer('flag_dr')->nullable();
            $table->integer('no_induk')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('kode_bagian', 8)->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->bigInteger('kode_trans_pelayanan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_fee_dokter_bpjs');
    }
};
