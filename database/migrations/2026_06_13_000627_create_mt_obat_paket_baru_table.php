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
        if (Schema::hasTable('mt_obat_paket_baru')) {
            return;
        }

        Schema::create('mt_obat_paket_baru', function (Blueprint $table) {
            $table->increments('id_mt_obat_paket');
            $table->integer('kode_tarif')->nullable();
            $table->string('kode_brg', 20);
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->char('satuan', 20)->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->string('nama_paket')->nullable();
            $table->string('nama_brg')->nullable();
            $table->decimal('harga', 19, 4)->nullable();
            $table->integer('id_paket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_obat_paket_baru');
    }
};
