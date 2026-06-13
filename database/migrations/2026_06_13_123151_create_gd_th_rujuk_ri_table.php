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
        Schema::create('gd_th_rujuk_ri', function (Blueprint $table) {
            $table->increments('kode_rujuk_ri');
            $table->string('no_mr', 50)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('keadaan_umum', 50)->nullable();
            $table->string('kesadaran_pasien', 50)->nullable();
            $table->string('tekanan_darah', 50)->nullable();
            $table->string('nadi', 50)->nullable();
            $table->string('suhu', 50)->nullable();
            $table->string('pernafasan', 50)->nullable();
            $table->string('berat_badan', 50)->nullable();
            $table->string('dokter_igd', 50)->nullable();
            $table->string('dokter_ri', 50)->nullable();
            $table->string('cara_pindah', 50)->nullable();
            $table->string('ruang_rujuk', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('rs_rujuk')->nullable();
            $table->integer('status_triase')->nullable();

            $table->primary(['kode_rujuk_ri'], 'pk_gd_tc_rujuk_ri');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gd_th_rujuk_ri');
    }
};
