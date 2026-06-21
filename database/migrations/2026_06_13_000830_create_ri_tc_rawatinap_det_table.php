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
        if (Schema::hasTable('ri_tc_rawatinap_det')) {
            return;
        }

        Schema::create('ri_tc_rawatinap_det', function (Blueprint $table) {
            $table->increments('kode_det');
            $table->integer('kode_ri');
            $table->text('diagnosa_awal')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('id_mt_icd_diagnosa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ri_tc_rawatinap_det');
    }
};
