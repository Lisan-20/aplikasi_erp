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
        if (Schema::hasTable('ks_tc_trans_um')) {
            return;
        }

        Schema::create('ks_tc_trans_um', function (Blueprint $table) {
            $table->increments('id_tc_trans_um');
            $table->integer('kode_tc_trans_kasir');
            $table->integer('no_registrasi_1');
            $table->integer('no_kunjungan');
            $table->string('no_mr', 8);
            $table->string('nama_pasien', 50)->nullable();
            $table->string('kode_bagian', 18);
            $table->integer('kd_kuitansi')->nullable();
            $table->integer('no_kuitansi_1');
            $table->decimal('tunai', 19, 4)->default(0);
            $table->decimal('debit', 19, 4)->default(0);
            $table->decimal('kredit', 19, 4)->default(0);
            $table->decimal('jumlah', 19, 4)->default(0);
            $table->integer('kd_bank_cc')->nullable();
            $table->integer('kd_bank_dc')->nullable();
            $table->dateTime('tgl_bayar')->nullable();
            $table->dateTime('tgl_eod')->nullable();
            $table->tinyInteger('flag_jurnal')->nullable();
            $table->integer('kode_tc_trans_kasir_bayar')->nullable()->comment('Bagian ini merupakan kode kuitansi ketika uang muka ini digunakan dalam pembayaran');
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('user_ver')->nullable();
            $table->integer('status_batal')->nullable();
            $table->bigInteger('kode_ri')->nullable();
            $table->bigInteger('kode_inap')->nullable();
            $table->bigInteger('no_registrasi')->nullable();
            $table->bigInteger('no_kuitansi')->nullable();

            $table->primary(['id_tc_trans_um'], 'pk_ks_tc_trans_um');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ks_tc_trans_um');
    }
};
