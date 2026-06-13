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
        Schema::create('tc_kredensialing', function (Blueprint $table) {
            $table->increments('id_kred');
            $table->string('npp', 30)->nullable();
            $table->string('nama_pegawai', 50)->nullable();
            $table->integer('id_pk')->nullable();
            $table->integer('id_kep')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->integer('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->dateTime('berakhir_tgl')->nullable();
            $table->string('no_sk', 50)->nullable();
            $table->dateTime('tgl_sk')->nullable();
            $table->integer('ko_wil')->nullable();
            $table->dateTime('tgl_isi_mandiri')->nullable();
            $table->integer('id_user_mandiri')->nullable();
            $table->dateTime('tgl_isi_tim')->nullable();
            $table->integer('id_user_tim')->nullable();
            $table->dateTime('tgl_rekomendasi')->nullable();
            $table->integer('id_user_rekomendasi')->nullable();
            $table->text('sartifikasi')->nullable();
            $table->text('ringkasan')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->text('catatan')->nullable();
            $table->string('nama_file', 250)->nullable();
            $table->integer('id_pengajuan')->nullable();
            $table->integer('soal_1')->nullable();
            $table->string('soal_1_text', 250)->nullable();
            $table->string('soal_2', 250)->nullable();
            $table->string('soal_2_text1', 250)->nullable();
            $table->string('soal_2_text2', 250)->nullable();
            $table->integer('soal_3')->nullable();
            $table->integer('flag_ver_ka_unit')->nullable();
            $table->dateTime('tgl_ver_ka_unit')->nullable();
            $table->text('alasan_tolak')->nullable();
            $table->dateTime('tgl_tolak')->nullable();
            $table->integer('user_tolak')->nullable();
            $table->integer('id_riwayat_pendidikan')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_jabatan')->nullable();
            $table->integer('STR_id_tc_surat_izin')->nullable();
            $table->integer('SIPP_id_tc_surat_izin')->nullable();
            $table->integer('id_user_ver_ka_unit')->nullable();
            $table->integer('id_kred_awal')->nullable();
            $table->integer('st_akhir')->nullable();
            $table->dateTime('st_akhir_tgl')->nullable();
            $table->integer('st_akhir_user')->nullable();
            $table->string('no_skpk', 250)->nullable();
            $table->dateTime('tgl_skpk')->nullable();
            $table->integer('id_dir_skpk')->nullable();
            $table->integer('id_luar')->nullable();
            $table->integer('npp_tim')->nullable();
            $table->dateTime('tgl_jadwal_tim')->nullable();
            $table->text('note_tim')->nullable();
            $table->integer('no_urut_rekom')->nullable();
            $table->string('no_surat_rekom', 250)->nullable();
            $table->text('alasan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kredensialing');
    }
};
