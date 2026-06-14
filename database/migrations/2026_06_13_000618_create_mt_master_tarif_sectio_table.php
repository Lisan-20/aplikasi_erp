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
        if (Schema::hasTable('mt_master_tarif_sectio')) {
            return;
        }

        Schema::create('mt_master_tarif_sectio', function (Blueprint $table) {
            $table->integer('kode_tarif');
            $table->string('kode_tindakan', 5)->nullable();
            $table->string('nama_tarif');
            $table->integer('tingkatan')->default(5);
            $table->string('ket')->nullable();
            $table->string('kode_bagian', 18);
            $table->integer('referensi')->nullable();
            $table->tinyInteger('jenis_tindakan')->nullable();
            $table->integer('paket_askes')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kode_grup_tindakan')->nullable();
            $table->integer('paket_mcu')->nullable();
            $table->integer('paket_ibu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_tarif_sectio');
    }
};
