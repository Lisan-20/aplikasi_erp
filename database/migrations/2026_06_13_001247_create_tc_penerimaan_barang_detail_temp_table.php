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
        if (Schema::hasTable('tc_penerimaan_barang_detail_temp')) {
            return;
        }

        Schema::create('tc_penerimaan_barang_detail_temp', function (Blueprint $table) {
            $table->integer('kode_detail_penerimaan_barang');
            $table->string('kode_brg', 20)->nullable();
            $table->string('kode_penerimaan', 20)->nullable();
            $table->integer('jumlah_pesan')->nullable();
            $table->integer('jumlah_kirim')->nullable();
            $table->integer('bonus_pesan')->nullable();
            $table->integer('bonus_kirim')->nullable();
            $table->integer('bonus_kurang')->nullable();
            $table->integer('content')->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('tgl_kadaluarsa')->nullable();
            $table->integer('id_tc_po_det')->nullable();
            $table->tinyInteger('flag_expired')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->string('no_batch', 50)->nullable();
            $table->decimal('harga_satuan', 19, 4)->nullable();
            $table->decimal('harga_total', 19, 4)->nullable();
            $table->string('no_faktur', 50)->nullable();
            $table->decimal('diskon', 19, 4)->nullable();
            $table->integer('diskon_persen_old')->nullable();
            $table->decimal('ppn', 18)->nullable();
            $table->decimal('ppn_rp', 19, 4)->nullable();
            $table->decimal('diskon_persen', 18)->nullable();
            $table->decimal('harga_satuan_netto', 19, 4)->nullable();
            $table->decimal('jumlah_harga_netto', 19, 4)->nullable();
            $table->integer('jumlah_kirim_po')->nullable();
            $table->string('satuan', 50)->nullable();
            $table->integer('flag_terima')->nullable();
            $table->integer('id_tc_trans_umd_det')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penerimaan_barang_detail_temp');
    }
};
