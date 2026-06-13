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
        Schema::create('mt_depo_stok_nm', function (Blueprint $table) {
            $table->increments('kode_depo_stok');
            $table->string('kode_brg', 20)->nullable();
            $table->integer('stok_minimum')->nullable();
            $table->integer('stok_maksimum')->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('kode_rekap_stok')->nullable();
            $table->integer('id_kartu')->nullable();
            $table->decimal('jml_sat_kcl', 18)->nullable();
            $table->string('nama_rak', 50)->nullable();
            $table->float('jml_sat_kcly', 53, 0)->nullable();

            $table->primary(['kode_depo_stok'], 'pk_mt_depo_stok_nm_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_depo_stok_nm');
    }
};
