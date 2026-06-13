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
        Schema::create('tc_kunjungan', function (Blueprint $table) {
            $table->increments('id_tc_kunjungan');
            $table->integer('no_kunjungan');
            $table->integer('no_registrasi_old')->index('ix_no_registrasi');
            $table->string('no_mr', 8);
            $table->string('kode_dokter', 10)->nullable();
            $table->string('kode_bagian_tujuan', 18)->nullable();
            $table->string('kode_bagian_asal', 18)->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->tinyInteger('status_masuk')->nullable()->comment('kalo rujuk, status_masuk=1; selain itu 0;');
            $table->tinyInteger('status_keluar')->nullable()->comment('meninggal=4; keluar hidup-hidup=3;');
            $table->integer('status_cito')->nullable();
            $table->string('keterangan', 18)->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('flag_um')->nullable();
            $table->integer('kode_tc_trans_kasir')->nullable();
            $table->dateTime('tgl_blpl')->nullable();
            $table->dateTime('tgl_pulang')->nullable();
            $table->integer('flag_icd')->nullable();
            $table->integer('user_pulang')->nullable();
            $table->integer('status_blpl')->nullable();
            $table->integer('flag_fisio')->nullable();
            $table->integer('user_batal')->nullable();
            $table->string('kode_bagian_batal', 18)->nullable();
            $table->integer('flag_titipan')->nullable();
            $table->integer('status_triase')->nullable();
            $table->dateTime('tgl_kontrol')->nullable();
            $table->integer('flag_wa')->nullable();
            $table->integer('flag_serah')->nullable();
            $table->dateTime('tgl_serah')->nullable();
            $table->integer('no_induk')->nullable();
            $table->text('ttd_resum')->nullable();
            $table->dateTime('tgl_jam_ttd')->nullable();
            $table->string('nama_wali_resum', 250)->nullable();
            $table->bigInteger('no_registrasi')->nullable();

            $table->primary(['no_kunjungan'], 'pk_tc_kunjungan_baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kunjungan');
    }
};
