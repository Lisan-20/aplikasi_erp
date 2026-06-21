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
        if (Schema::hasTable('transaksi_piutang_afiliasi_bayar')) {
            return;
        }

        Schema::create('transaksi_piutang_afiliasi_bayar', function (Blueprint $table) {
            $table->integer('id_trans_piutang_afls_bayar');
            $table->integer('id_trans_piutang_afls')->nullable();
            $table->string('no_kuitansi_bayar', 25)->nullable();
            $table->dateTime('tgl_bayar')->nullable();
            $table->decimal('jumlah_bayar', 18, 0)->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('user_ver')->nullable();
            $table->integer('no_urut_kuitansi')->nullable();
            $table->decimal('diskon', 19, 4)->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('id_bd_tc_trans')->nullable();
            $table->decimal('biaya_transfer', 18)->nullable();
            $table->decimal('pajak', 18)->nullable();
            $table->decimal('tagihan_tidak_dicover', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_piutang_afiliasi_bayar');
    }
};
