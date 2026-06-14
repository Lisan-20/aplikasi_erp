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
        if (Schema::hasTable('sie_rujukan')) {
            return;
        }

        Schema::create('sie_rujukan', function (Blueprint $table) {
            $table->increments('id_rujukan');
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->integer('jml_pasien_rj')->nullable();
            $table->integer('jml_pemeriksaan_rj')->nullable();
            $table->integer('jml_pasien_ri')->nullable();
            $table->integer('jml_pemeriksaan_ri')->nullable();
            $table->integer('jml_lama')->nullable();
            $table->integer('jml_baru')->nullable();
            $table->integer('id_dc_asal_pasien')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('flag_golongan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sie_rujukan');
    }
};
