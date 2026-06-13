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
        Schema::create('th_riwayat_pasien', function (Blueprint $table) {
            $table->increments('kode_riwayat');
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('nama_pasien')->nullable();
            $table->string('diagnosa_awal', 2000)->nullable();
            $table->string('anamnesa', 2000)->nullable();
            $table->string('pengobatan', 2000)->nullable();
            $table->string('dokter_pemeriksa', 2000)->nullable();
            $table->string('pemeriksaan', 2000)->nullable();
            $table->dateTime('tgl_periksa')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('diagnosa_akhir', 2000)->nullable();
            $table->integer('kode_icd_diagnosa')->nullable()->default(0);
            $table->dateTime('tgl_input')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('alergi', 2000)->nullable();
            $table->integer('kd_dr_pemeriksa')->nullable();
            $table->string('diagnosa', 2000)->nullable();
            $table->integer('flag_entry')->nullable();
            $table->string('diagnosa_awal_tambahan', 2000)->nullable();
            $table->string('kode_ICD9', 50)->nullable();
            $table->string('ICD9', 2000)->nullable();
            $table->integer('flag_jenis_diag')->nullable();
            $table->string('keluhan', 2000)->nullable();
            $table->string('keadaan_umum', 2000)->nullable();
            $table->text('terapi')->nullable();
            $table->text('soap')->nullable();
            $table->string('no_dp', 50)->nullable();
            $table->string('kode_icdX', 250)->nullable();
            $table->integer('flag_resum')->nullable();
            $table->decimal('plafon_bpjs', 19, 4)->nullable();

            $table->primary(['kode_riwayat'], 'pk_tch_riwayat_pasien');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_riwayat_pasien');
    }
};
