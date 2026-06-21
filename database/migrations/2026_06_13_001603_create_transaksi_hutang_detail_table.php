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
        if (Schema::hasTable('transaksi_hutang_detail')) {
            return;
        }

        Schema::create('transaksi_hutang_detail', function (Blueprint $table) {
            $table->increments('id_trans_hutang_detail');
            $table->integer('id_trans_hutang');
            $table->string('acc_no', 8);
            $table->string('no_ref', 20)->nullable();
            $table->integer('jumlah');
            $table->integer('tipe_tx');
            $table->integer('kode_akun_detail')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kode_supplier')->nullable();
            $table->integer('kode_dr')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('input_id');
            $table->dateTime('input_tgl');
            $table->tinyInteger('status')->nullable()->default(0);
            $table->dateTime('status_tgl')->nullable();
            $table->integer('status_id')->nullable();

            $table->primary(['id_trans_hutang_detail'], 'pk_transaksi_hutang_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_hutang_detail');
    }
};
