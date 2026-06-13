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
        Schema::create('tc_p3k', function (Blueprint $table) {
            $table->integer('id_tc_baksos');
            $table->dateTime('tgl_transaksi')->nullable();
            $table->string('kode_brg', 20);
            $table->string('nama_brg', 50)->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->decimal('harga_jual', 19, 4)->nullable();
            $table->decimal('total_harga', 19, 4)->nullable();
            $table->integer('jumlah')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('no_induk')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('kode_trans_far')->nullable();
            $table->integer('kd_tr_resep')->nullable();
            $table->integer('kode_profit')->nullable();
            $table->integer('kode_bagian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_p3k');
    }
};
