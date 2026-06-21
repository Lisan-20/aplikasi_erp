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
        if (Schema::hasTable('tc_kartu_stok_nm')) {
            return;
        }

        Schema::create('tc_kartu_stok_nm', function (Blueprint $table) {
            $table->increments('id_kartu');
            $table->dateTime('tgl_input')->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->integer('stok_awal')->nullable();
            $table->integer('pemasukan')->nullable();
            $table->integer('pengeluaran')->nullable();
            $table->integer('stok_akhir')->nullable();
            $table->integer('jenis_transaksi')->nullable();
            $table->string('kode_bagian', 20)->nullable();
            $table->string('keterangan3')->nullable();
            $table->string('petugas', 20)->nullable();
            $table->text('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kartu_stok_nm');
    }
};
