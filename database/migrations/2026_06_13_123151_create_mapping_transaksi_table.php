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
        Schema::create('mapping_transaksi', function (Blueprint $table) {
            $table->integer('kode_mapping_transaksi');
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('kode_proses')->nullable();
            $table->integer('kode_jenis_proses')->nullable();
            $table->string('acc_debet', 50)->nullable();
            $table->string('acc_kredit', 50)->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('no_urut')->nullable();
            $table->string('kode_bagian_asal', 18)->nullable();

            $table->primary(['kode_mapping_transaksi'], 'pk_mapping_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapping_transaksi');
    }
};
