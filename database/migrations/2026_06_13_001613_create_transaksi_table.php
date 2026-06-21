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
        if (Schema::hasTable('transaksi')) {
            return;
        }

        Schema::create('transaksi', function (Blueprint $table) {
            $table->integer('id_transaksi');
            $table->integer('id_transaksi_ref')->nullable();
            $table->integer('flag_modul');
            $table->integer('jumlah_transaksi');
            $table->string('no_bukti', 50);
            $table->string('no_bp', 50);
            $table->dateTime('tgl_transaksi');
            $table->tinyInteger('flag_tmp');
            $table->integer('flag_jurnal')->default(0);
            $table->string('keterangan')->nullable();
            $table->dateTime('inp_tgl');
            $table->integer('inp_id')->nullable();
            $table->integer('kd_wil')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_supplier')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kode_dr')->nullable();
            $table->tinyInteger('stat')->default(0);
            $table->integer('stat_id')->nullable();
            $table->dateTime('tgl_eod')->nullable();
            $table->integer('flag_ver')->nullable();
            $table->dateTime('tgl_ver')->nullable();

            $table->primary(['id_transaksi'], 'pk_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
