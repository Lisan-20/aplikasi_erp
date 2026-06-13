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
        Schema::create('tc_kontrol_bpjs', function (Blueprint $table) {
            $table->increments('id_kontrol_bpjs');
            $table->string('noSuratKontrol', 50)->nullable();
            $table->dateTime('tglRencanaKontrol')->nullable();
            $table->string('namaDokter', 50)->nullable();
            $table->string('noKartu', 50)->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('kelamin', 50)->nullable();
            $table->dateTime('tglLahir')->nullable();
            $table->text('diagnosa')->nullable();
            $table->integer('flag_hapus_kontrol')->nullable();
            $table->string('noSep', 50)->nullable();
            $table->string('poli', 50)->nullable();
            $table->string('jenis', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->dateTime('tgl_hapus_kontrol')->nullable();
            $table->integer('flag_wa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kontrol_bpjs');
    }
};
