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
        if (Schema::hasTable('th_ceklis_keselamatan_op')) {
            return;
        }

        Schema::create('th_ceklis_keselamatan_op', function (Blueprint $table) {
            $table->increments('id_ceklis_keselamatan_op');
            $table->string('no_mr', 12)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('nama_pasien', 30)->nullable();
            $table->dateTime('tgl_tindakan')->nullable();
            $table->string('tindakan', 50)->nullable();
            $table->string('diag_pas_bedah', 50)->nullable();
            $table->string('dr_operator', 50)->nullable();
            $table->string('sirkuler', 50)->nullable();
            $table->string('asisten', 50)->nullable();
            $table->string('mulai_op', 10)->nullable();
            $table->string('konfirmasi_pas_op', 6)->nullable();
            $table->string('penandaan_luka_op', 6)->nullable();
            $table->string('pros_bedah_cek', 6)->nullable();
            $table->string('srt_izin_op', 6)->nullable();
            $table->string('dok_pas', 6)->nullable();
            $table->string('pengkajian_pas', 6)->nullable();
            $table->string('msn_obt_anes', 6)->nullable();
            $table->string('pulse_oxi', 6)->nullable();
            $table->string('rwyt_alergi', 6)->nullable();
            $table->string('resiko_nfs', 6)->nullable();
            $table->string('resiko_drh', 6)->nullable();
            $table->string('saat_op', 10)->nullable();
            $table->string('konfirmasi_pas_to', 6)->nullable();
            $table->string('nama_pas_to', 6)->nullable();
            $table->string('pros_to', 6)->nullable();
            $table->string('insisi_to', 6)->nullable();
            $table->string('prof_to', 6)->nullable();
            $table->string('review_dr_to', 6)->nullable();
            $table->text('txt_review_dr_to')->nullable();
            $table->string('review_anes_to', 6)->nullable();
            $table->text('txt_review_anes_to')->nullable();
            $table->string('review_perawat_to', 6)->nullable();
            $table->text('txt_review_perawat_to')->nullable();
            $table->string('selesai_op', 10)->nullable();
            $table->string('tindakan_so', 6)->nullable();
            $table->string('nama_pros_tin_so', 6)->nullable();
            $table->string('instrumen_so', 6)->nullable();
            $table->string('spesimen_so', 6)->nullable();
            $table->string('masalah_so', 6)->nullable();
            $table->string('pindah_pas_so', 6)->nullable();
            $table->string('implant_so', 6)->nullable();
            $table->string('jns_implant_so', 20)->nullable();
            $table->string('komplikasi_so', 50)->nullable();
            $table->string('proses_sembuh_so', 6)->nullable();
            $table->text('txt_proses_sembuh_so')->nullable();
            $table->integer('user_id')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('dr_anes', 50)->nullable();
            $table->integer('kode_petugas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_ceklis_keselamatan_op');
    }
};
