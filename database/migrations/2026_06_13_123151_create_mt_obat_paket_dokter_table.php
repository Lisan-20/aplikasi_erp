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
        Schema::create('mt_obat_paket_dokter', function (Blueprint $table) {
            $table->increments('id_mt_obat_dr');
            $table->integer('kode_paket')->nullable();
            $table->string('kode_dokter', 10)->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->char('satuan', 20)->nullable();
            $table->string('nama_brg')->nullable();
            $table->decimal('harga', 19, 4)->nullable();
            $table->integer('takaran')->nullable();
            $table->integer('penggunaan')->nullable();
            $table->string('instruksi', 200)->nullable();
            $table->string('jml_pakai', 50)->nullable();
            $table->string('jml_takar', 50)->nullable();
            $table->decimal('jml_konversi', 18)->nullable();
            $table->integer('komp_dtd')->nullable();
            $table->text('racikan_obat_tambahan')->nullable();
            $table->integer('racik')->nullable();
            $table->integer('flag_kirim')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_obat_paket_dokter');
    }
};
