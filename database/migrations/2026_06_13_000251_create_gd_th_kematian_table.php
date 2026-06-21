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
        if (Schema::hasTable('gd_th_kematian')) {
            return;
        }

        Schema::create('gd_th_kematian', function (Blueprint $table) {
            $table->increments('kode_meninggal');
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('kode_gd', 50)->nullable();
            $table->string('dokter_asal', 50)->nullable();
            $table->string('meninggal_instruksi')->nullable();
            $table->string('meninggal_hari', 50)->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->integer('status_triase')->nullable();
            $table->integer('status_mati')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gd_th_kematian');
    }
};
