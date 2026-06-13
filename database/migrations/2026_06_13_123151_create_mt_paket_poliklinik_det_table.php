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
        Schema::create('mt_paket_poliklinik_det', function (Blueprint $table) {
            $table->increments('kode_paket_det');
            $table->string('nama_tindakan')->nullable();
            $table->integer('kode_tarif')->nullable();
            $table->string('kode_barang', 20)->nullable();
            $table->integer('jenis_tindakan')->nullable();
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->decimal('bill_rs', 19, 4)->nullable();
            $table->decimal('bill_dr1', 19, 4)->nullable();
            $table->decimal('lain_lain', 19, 4)->nullable();
            $table->integer('kode_paket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_paket_poliklinik_det');
    }
};
