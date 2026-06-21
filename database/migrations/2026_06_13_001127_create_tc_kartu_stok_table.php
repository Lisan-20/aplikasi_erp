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
        if (Schema::hasTable('tc_kartu_stok')) {
            return;
        }

        Schema::create('tc_kartu_stok', function (Blueprint $table) {
            $table->increments('id_kartu');
            $table->dateTime('tgl_input')->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->decimal('stok_awal', 18)->nullable();
            $table->decimal('pemasukan', 18)->nullable();
            $table->decimal('pengeluaran', 18)->nullable();
            $table->decimal('stok_akhir', 18)->nullable();
            $table->integer('jenis_transaksi')->nullable();
            $table->string('kode_bagian', 20)->nullable();
            $table->string('keterangan')->nullable();
            $table->string('petugas', 20)->nullable();
            $table->decimal('pemasukan_b', 18)->nullable();
            $table->decimal('pengeluaran_b', 18)->nullable();
            $table->bigInteger('kode_detail_penerimaan_barang')->nullable();
            $table->string('no_batch', 50)->nullable();
            $table->dateTime('tgl_kadaluarsa')->nullable();
            $table->integer('kode_trans_far')->nullable();
            $table->text('keterangan2')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('no_induk')->nullable();

            $table->primary(['id_kartu'], 'pk_tc_kartu_stok_baru_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kartu_stok');
    }
};
