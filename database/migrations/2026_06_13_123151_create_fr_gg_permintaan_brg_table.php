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
        Schema::create('fr_gg_permintaan_brg', function (Blueprint $table) {
            $table->increments('id_permintaan_brg');
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('jumlah_minta')->nullable();
            $table->string('kode_barang', 50)->nullable();
            $table->string('nama_barang', 50)->nullable();

            $table->primary(['id_permintaan_brg'], 'pk_fr_gg_permintaan_brg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_gg_permintaan_brg');
    }
};
