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
        if (Schema::hasTable('tc_trans_gudang')) {
            return;
        }

        Schema::create('tc_trans_gudang', function (Blueprint $table) {
            $table->integer('kode_tc_trans_gudang');
            $table->integer('kode_trans_gudang')->nullable();
            $table->integer('kd_tr_kirim')->nullable();
            $table->integer('rs_cabang')->nullable()->default(0);
            $table->string('nama_rs_cabang')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->string('nama_brg', 50)->nullable();
            $table->decimal('total_harga', 19, 4)->default(0);
            $table->decimal('harga_sat', 19, 4)->nullable();
            $table->decimal('lain_lain', 19, 4)->default(0);
            $table->decimal('jumlah', 19, 4)->default(0);
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('kode_profit')->nullable();
            $table->tinyInteger('status_selesai')->nullable()->default(0)->comment('2 --> Siap Billing, 3 --> Sudah Dibayar');
            $table->tinyInteger('flag_jurnal')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('petugas')->nullable();
            $table->dateTime('tgl_bayar')->nullable();
            $table->integer('status_bayar')->nullable();
            $table->integer('id_bd_tc_trans')->nullable();
            $table->string('satuan', 50)->nullable();

            $table->primary(['kode_tc_trans_gudang'], 'pk_tc_trans_gudang_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_trans_gudang');
    }
};
