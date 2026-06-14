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
        if (Schema::hasTable('tc_riwayat_edit_barang')) {
            return;
        }

        Schema::create('tc_riwayat_edit_barang', function (Blueprint $table) {
            $table->increments('id_riwayat_barang');
            $table->integer('user_edit')->nullable();
            $table->dateTime('tgl_edit')->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->decimal('harga_beli', 18)->nullable();
            $table->decimal('harga_persediaan', 18)->nullable();
            $table->decimal('harga_sebelumnya', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_riwayat_edit_barang');
    }
};
