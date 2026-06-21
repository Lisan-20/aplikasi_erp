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
        if (Schema::hasTable('tc_pembayaran')) {
            return;
        }

        Schema::create('tc_pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->integer('id_pendaftaran')->nullable();
            $table->string('no_bukti', 50)->nullable();
            $table->string('nama_pembayar', 50)->nullable();
            $table->integer('no_induk')->nullable();
            $table->dateTime('tgl_jam_bayar')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('tunai')->nullable();
            $table->integer('debet')->nullable();
            $table->integer('diskon')->nullable();
            $table->integer('kode_bank')->nullable();
            $table->integer('pengembalian_um')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('jenis_bayar')->nullable();
            $table->integer('kartu_kredit')->nullable();
            $table->integer('flag_cc')->nullable();
            $table->integer('no_val_cc')->nullable();
            $table->integer('no_val_debet')->nullable();

            $table->primary(['id_pembayaran'], 'pk_tc_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pembayaran');
    }
};
