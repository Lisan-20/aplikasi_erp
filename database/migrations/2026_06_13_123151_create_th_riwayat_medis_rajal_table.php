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
        Schema::create('th_riwayat_medis_rajal', function (Blueprint $table) {
            $table->integer('id_riwayat_medis_rajal');
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->dateTime('tgl')->nullable();
            $table->string('anamnesa', 2000)->nullable();
            $table->string('diagnosa', 2000)->nullable();
            $table->string('terapi', 2000)->nullable();
            $table->char('kode_dokter', 10)->nullable();
            $table->integer('kode_icd')->nullable();

            $table->primary(['id_riwayat_medis_rajal'], 'pk_th_riwayat_medis_rajal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_riwayat_medis_rajal');
    }
};
