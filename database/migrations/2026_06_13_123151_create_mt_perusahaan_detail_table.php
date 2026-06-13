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
        Schema::create('mt_perusahaan_detail', function (Blueprint $table) {
            $table->increments('id_mt_perusahaan_detail');
            $table->integer('kode_perusahaan')->nullable();
            $table->string('jenis_tindakan')->nullable();
            $table->string('jenis_layanan')->nullable();
            $table->string('pelayanan')->nullable();
            $table->string('lab')->nullable();
            $table->string('rehab_medik')->nullable();
            $table->string('obat')->nullable();
            $table->string('tarif_dr')->nullable();
            $table->string('discon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_perusahaan_detail');
    }
};
