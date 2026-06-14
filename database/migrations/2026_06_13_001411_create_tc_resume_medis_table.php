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
        if (Schema::hasTable('tc_resume_medis')) {
            return;
        }

        Schema::create('tc_resume_medis', function (Blueprint $table) {
            $table->integer('id_resume_medis');
            $table->string('no_mr', 10)->nullable();
            $table->string('diagnosis', 500)->nullable();
            $table->string('terapi', 500)->nullable();
            $table->string('pemeriksaan_fisik', 500)->nullable();
            $table->string('rencana_pemeriksaan', 500)->nullable();
            $table->integer('kode_bagian_kontrol_old')->nullable();
            $table->dateTime('tgl_kontrol')->nullable();
            $table->integer('kode_paramedis')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('id_user')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('kode_bagian_kontrol', 8)->nullable();

            $table->primary(['id_resume_medis'], 'pk_tc_resume_medis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_resume_medis');
    }
};
