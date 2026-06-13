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
        Schema::create('mt_pola_tarif', function (Blueprint $table) {
            $table->increments('id_pola_tarif');
            $table->integer('kode_kelompok')->nullable();
            $table->integer('bill_rs')->nullable();
            $table->integer('bill_dr1')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('kode_jenis_tindakan')->nullable();
            $table->string('kode_tarif', 20)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->integer('kode_perusahaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_pola_tarif');
    }
};
