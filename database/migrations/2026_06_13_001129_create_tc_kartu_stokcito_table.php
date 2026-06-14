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
        if (Schema::hasTable('tc_kartu_stokcito')) {
            return;
        }

        Schema::create('tc_kartu_stokcito', function (Blueprint $table) {
            $table->integer('id_kartucito');
            $table->dateTime('tgl_input')->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->integer('stok_awal')->nullable();
            $table->integer('pemasukan')->nullable();
            $table->integer('pengeluaran')->nullable();
            $table->integer('stok_akhir')->nullable();
            $table->integer('jenis_transaksi')->nullable();
            $table->string('kode_bagian', 20)->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('petugas')->nullable();

            $table->primary(['id_kartucito'], 'pk_tc_kartu_stokcito');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kartu_stokcito');
    }
};
