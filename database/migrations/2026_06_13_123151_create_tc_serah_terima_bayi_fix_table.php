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
        if (Schema::hasTable('tc_serah_terima_bayi_fix')) {
            return;
        }

        Schema::create('tc_serah_terima_bayi_fix', function (Blueprint $table) {
            $table->increments('id_info_bayi');
            $table->text('nama_bayi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->text('tanda_vital')->nullable();
            $table->string('keadaan_umum', 10)->nullable();
            $table->string('suhu', 50)->nullable();
            $table->string('nadi', 50)->nullable();
            $table->string('respirasi', 50)->nullable();
            $table->integer('kode_paramedis1')->nullable();
            $table->integer('kode_paramedis2')->nullable();
            $table->string('nama_keluarga', 50)->nullable();
            $table->string('hub_pasien', 50)->nullable();
            $table->dateTime('tgl_lahir')->nullable();
            $table->string('berat_badan', 50)->nullable();
            $table->string('panjang_badan', 50)->nullable();
            $table->integer('user_input')->nullable();
            $table->text('obat_yg_diberikan')->nullable();
            $table->string('spo2_kaki', 50)->nullable();
            $table->string('spo2_tangan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_serah_terima_bayi_fix');
    }
};
