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
        if (Schema::hasTable('gd_th_rujuk_rs')) {
            return;
        }

        Schema::create('gd_th_rujuk_rs', function (Blueprint $table) {
            $table->integer('kode_rujuk_lain');
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
            $table->dateTime('tgl_input')->nullable();
            $table->integer('rs_rujuk')->nullable();
            $table->string('alasan_rujuk', 50)->nullable();
            $table->string('kode_bagian_asal', 50)->nullable();
            $table->integer('status_triase')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gd_th_rujuk_rs');
    }
};
