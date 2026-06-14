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
        if (Schema::hasTable('th_icd10_pasien_harian_temp')) {
            return;
        }

        Schema::create('th_icd10_pasien_harian_temp', function (Blueprint $table) {
            $table->increments('kode_icd_pasien');
            $table->dateTime('tgl_jam')->nullable();
            $table->string('kode_icd', 50)->nullable();
            $table->string('kode_asterik', 50)->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('group_depkes')->nullable()->default(0);
            $table->integer('no_registrasi')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->text('diagnosa')->nullable();
            $table->text('tipe_rl')->nullable();
            $table->integer('status_itung')->nullable();
            $table->integer('umur')->nullable();
            $table->string('gender', 50)->nullable();
            $table->integer('status_hidup')->nullable();
            $table->integer('jns_penyakit')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('sys_lama')->nullable();
            $table->integer('plafon_bpjs')->nullable();
            $table->string('ket_status_pasien', 50)->nullable();
            $table->string('rs_rujukan', 50)->nullable();
            $table->string('goldar', 10)->nullable();
            $table->string('jenis_darah', 50)->nullable();
            $table->integer('jml_kantong')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('kode_riwayat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_icd10_pasien_harian_temp');
    }
};
