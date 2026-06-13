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
        Schema::create('mt_rujukan_bpjs', function (Blueprint $table) {
            $table->increments('id_rujukan_bpjs');
            $table->string('kdAslRjk', 50)->nullable();
            $table->string('nmAslRjk', 50)->nullable();
            $table->string('kdDiag', 50)->nullable();
            $table->string('nmDiagxxx', 50)->nullable();
            $table->string('noRujukan', 50)->nullable();
            $table->string('asuransi', 50)->nullable();
            $table->string('hakKelas', 50)->nullable();
            $table->string('jnsPeserta', 50)->nullable();
            $table->string('kelamin', 50)->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('noKartu', 50)->nullable();
            $table->string('noMr', 50)->nullable();
            $table->dateTime('tglLahir')->nullable();
            $table->string('kdPoliTuj', 50)->nullable();
            $table->string('nmPoliTuj', 50)->nullable();
            $table->dateTime('tglBerlakuKunjungan')->nullable();
            $table->dateTime('tglRencanaKunjungan')->nullable();
            $table->dateTime('tglRujukan')->nullable();
            $table->string('kdTujRujuk', 50)->nullable();
            $table->string('nmTujRujuk', 50)->nullable();
            $table->integer('flag_hapus_vclaim')->nullable();
            $table->text('nmDiag')->nullable();
            $table->text('catatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_rujukan_bpjs');
    }
};
