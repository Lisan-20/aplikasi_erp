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
        Schema::create('fr_gg_kirim_brg', function (Blueprint $table) {
            $table->increments('id_kirim_brg');
            $table->string('no_bukti', 50)->nullable();
            $table->dateTime('tgl_kirim')->nullable();
            $table->string('kode_barang', 50)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('jumlah_minta')->nullable();
            $table->integer('jumlah_kirim')->nullable();
            $table->string('id_petugas_gudang', 50)->nullable();
            $table->string('id_petugas_unit', 50)->nullable();

            $table->primary(['id_kirim_brg'], 'pk_fr_gg_kirim_brg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_gg_kirim_brg');
    }
};
