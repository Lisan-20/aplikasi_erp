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
        Schema::create('tc_resep_dokter', function (Blueprint $table) {
            $table->increments('id_resep');
            $table->text('resep_dokter')->nullable();
            $table->string('no_mr', 6)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('kode_poli')->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->dateTime('tgl_resep')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('no_induk')->nullable();
            $table->text('message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_resep_dokter');
    }
};
