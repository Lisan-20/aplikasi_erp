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
        Schema::create('gd_fr_tc_gudang_detail', function (Blueprint $table) {
            $table->integer('kd_tr_kirim');
            $table->integer('kode_trans_gudang')->nullable();
            $table->integer('jumlah_pesan')->nullable();
            $table->integer('jumlah_tebus')->nullable();
            $table->integer('sisa')->nullable();
            $table->integer('jumlah_retur')->nullable();
            $table->integer('harga_r_retur')->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->integer('harga_beli')->nullable();
            $table->integer('harga_jual')->nullable();
            $table->integer('harga_r')->nullable();
            $table->integer('biaya_tebus')->nullable();
            $table->integer('status_kirim')->nullable();
            $table->integer('status_retur')->nullable();
            $table->integer('kode_cito')->nullable();
            $table->integer('racik')->nullable();
            $table->decimal('diskon', 18, 0)->nullable();
            $table->integer('kode_diskon')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('user_ver')->nullable();
            $table->integer('pilih_satuan')->nullable();
            $table->string('satuan', 50)->nullable();

            $table->primary(['kd_tr_kirim'], 'pk_gd_fr_tc_gudang_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gd_fr_tc_gudang_detail');
    }
};
