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
        if (Schema::hasTable('tc_trans_kartu')) {
            return;
        }

        Schema::create('tc_trans_kartu', function (Blueprint $table) {
            $table->integer('kode_trans_kartu');
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('nama_pasien')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->decimal('jumlah_transaksi', 18, 0)->nullable();
            $table->tinyInteger('flag_jurnal')->nullable()->default(0);
            $table->tinyInteger('flag_bayar')->nullable()->default(0)->comment('0 -> Belum dibayar, 1 -> Sudah dibayar');
            $table->dateTime('tgl_eod')->nullable();
            $table->integer('no_kunjungan')->nullable();

            $table->primary(['kode_trans_kartu'], 'pk_tc_trans_kartu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_trans_kartu');
    }
};
