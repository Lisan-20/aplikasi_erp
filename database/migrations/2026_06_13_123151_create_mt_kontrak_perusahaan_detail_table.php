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
        Schema::create('mt_kontrak_perusahaan_detail', function (Blueprint $table) {
            $table->increments('id_mt_perusahaan_detail');
            $table->string('no_kontrak', 50)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('rawat_inap')->nullable();
            $table->string('rawat_jalan')->nullable();
            $table->string('pembedahan')->nullable();
            $table->string('lab')->nullable();
            $table->string('Radiologi')->nullable();
            $table->string('obat')->nullable();
            $table->string('penunjang_medis_lain')->nullable();
            $table->string('diskon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kontrak_perusahaan_detail');
    }
};
