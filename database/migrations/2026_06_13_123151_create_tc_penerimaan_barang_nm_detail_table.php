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
        Schema::create('tc_penerimaan_barang_nm_detail', function (Blueprint $table) {
            $table->increments('kode_detail_penerimaan_barang');
            $table->string('kode_brg', 20)->nullable();
            $table->string('kode_penerimaan', 20)->nullable();
            $table->decimal('jumlah_pesan', 19, 4)->nullable();
            $table->decimal('jumlah_kirim', 19, 4)->nullable();
            $table->decimal('bonus_pesan', 19, 4)->nullable();
            $table->decimal('bonus_kirim', 19, 4)->nullable();
            $table->decimal('bonus_kurang', 19, 4)->nullable();
            $table->integer('content')->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('tgl_kadaluarsa')->nullable();
            $table->integer('id_tc_po_det')->nullable();
            $table->string('tempat', 100)->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->decimal('harga', 18)->nullable();
            $table->decimal('harga_total', 18)->nullable();
            $table->integer('id_tc_trans_umd_det')->nullable();
            $table->string('satuan', 25)->nullable();

            $table->primary(['kode_detail_penerimaan_barang'], 'pk_tc_penerimaan_barang_nm_detail_ne');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penerimaan_barang_nm_detail');
    }
};
