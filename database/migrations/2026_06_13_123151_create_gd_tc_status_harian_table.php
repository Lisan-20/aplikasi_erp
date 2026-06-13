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
        Schema::create('gd_tc_status_harian', function (Blueprint $table) {
            $table->integer('kd_status_harian');
            $table->integer('kd_tind_igd')->nullable();
            $table->integer('kode_gd')->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('lap_dokter')->nullable();
            $table->string('diagnosa_banding')->nullable();
            $table->string('pengobatan')->nullable();
            $table->string('instr_lanj')->nullable();
            $table->string('instr_pend')->nullable();
            $table->string('tek_darah', 50)->nullable();
            $table->string('no_induk', 50)->nullable();
            $table->string('pp')->nullable();
            $table->string('nadi')->nullable();
            $table->string('suhu')->nullable();
            $table->string('pupil')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('kesadaran_pasien')->nullable();
            $table->string('keadaan_umum', 50)->nullable();
            $table->string('no_mr', 6)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('kode_kunjungan', 18)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->string('kode_dokter', 10)->nullable();

            $table->primary(['kd_status_harian'], 'pk__gd_tc_status_har__4e4a4b60');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gd_tc_status_harian');
    }
};
