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
        if (Schema::hasTable('tc_permintaan_rekanan_det')) {
            return;
        }

        Schema::create('tc_permintaan_rekanan_det', function (Blueprint $table) {
            $table->integer('id_tc_permintaan_rekanan_det');
            $table->integer('id_tc_permintaan_rekanan')->nullable();
            $table->decimal('jumlah_permintaan', 10, 0)->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->string('satuan', 50)->nullable();
            $table->dateTime('tgl_kirim')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->integer('penerimaan_brg')->nullable();
            $table->integer('kekurangan')->nullable();
            $table->decimal('jumlah_penerimaan', 10, 0)->nullable();
            $table->integer('flag')->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->decimal('harga_jual', 19, 4)->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_permintaan_rekanan_det');
    }
};
