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
        Schema::create('tc_paket_ok', function (Blueprint $table) {
            $table->integer('id_tc_paket_ok');
            $table->string('kode_brg', 20)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_mr')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->string('nama_brg', 250)->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->decimal('harga_jual', 19, 4)->nullable();
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->string('kode_bagian', 10)->nullable();

            $table->primary(['id_tc_paket_ok'], 'pk_tc_paket_ok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_paket_ok');
    }
};
