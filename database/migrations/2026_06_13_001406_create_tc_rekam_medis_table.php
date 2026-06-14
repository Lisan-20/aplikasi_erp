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
        if (Schema::hasTable('tc_rekam_medis')) {
            return;
        }

        Schema::create('tc_rekam_medis', function (Blueprint $table) {
            $table->integer('kode_rekam_medis');
            $table->string('icd_10', 10);
            $table->integer('id_asterik');
            $table->integer('kode_poli')->nullable();
            $table->string('kode_kunjungan', 18)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->string('kode_dokter', 10)->nullable();
            $table->string('diagnosa', 20)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('pengobatan', 20)->nullable();
            $table->integer('kode_gd')->nullable();
            $table->integer('kode_ri')->nullable();

            $table->primary(['kode_rekam_medis', 'icd_10', 'id_asterik'], 'pk__tc_rekam_medis__6562bae2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_rekam_medis');
    }
};
