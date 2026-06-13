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
        Schema::create('tc_registrasi_temp', function (Blueprint $table) {
            $table->increments('id_tc_registrasi');
            $table->integer('no_registrasi');
            $table->string('no_mr', 8)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->string('kode_dokter', 50)->nullable();
            $table->string('no_induk', 50)->nullable();
            $table->dateTime('tgl_jam_masuk')->nullable();
            $table->dateTime('tgl_jam_keluar')->nullable();
            $table->string('prioritas', 20)->nullable();
            $table->string('kode_bagian_masuk', 18)->nullable();
            $table->string('kode_bagian_keluar', 18)->nullable();
            $table->string('status_batal', 10)->nullable();
            $table->string('stat_pasien', 4)->nullable();
            $table->tinyInteger('status_registrasi')->nullable();
            $table->integer('umur_old')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_paket')->nullable();
            $table->string('no_jaminan', 50)->nullable();
            $table->string('nik', 50)->nullable();
            $table->integer('kode_pt')->nullable();
            $table->string('nama_pt')->nullable();
            $table->integer('status_man')->nullable();
            $table->string('no_jkn', 50)->nullable();
            $table->string('no_skp', 100)->nullable();
            $table->decimal('plafon_bpjs', 19, 4)->nullable();
            $table->string('diagnosa')->nullable();
            $table->integer('kode_plafon')->nullable();
            $table->integer('byr_selisih')->nullable();
            $table->integer('flag_daftar')->nullable();
            $table->integer('st_daftar_ulang')->nullable();
            $table->integer('status_milik')->nullable();
            $table->integer('kode_penanggung')->nullable();
            $table->decimal('umur', 18, 0)->nullable();
            $table->integer('id_dc_asal_pasien')->nullable();
            $table->integer('flag_dr_fis_perujuk')->nullable();
            $table->string('nama_karyawan', 70)->nullable();
            $table->integer('flag_status')->nullable();
            $table->string('noKartuPeserta', 50)->nullable();
            $table->dateTime('tglSep')->nullable();
            $table->dateTime('tglRujukan')->nullable();
            $table->string('noRujukan', 250)->nullable();
            $table->string('ppkRujukan', 50)->nullable();
            $table->string('ppkPelayanan', 50)->nullable();
            $table->string('jnsPelayanan', 2)->nullable();
            $table->text('catatan')->nullable();
            $table->string('kdDiag', 50)->nullable();
            $table->string('diagAwal', 250)->nullable();
            $table->string('poliTujuan', 50)->nullable();
            $table->string('klsRawat', 10)->nullable();
            $table->string('userInp', 50)->nullable();
            $table->string('noMr', 50)->nullable();
            $table->string('noSep', 250)->nullable();
            $table->integer('milike')->nullable();
            $table->string('jnsPeserta', 250)->nullable();
            $table->integer('flag_igd')->nullable();
            $table->string('lakaLantas', 50)->nullable();
            $table->string('lokasiLaka', 150)->nullable();
            $table->dateTime('tgl_status')->nullable();
            $table->dateTime('tgl_status2')->nullable();
            $table->dateTime('tgl_status3')->nullable();
            $table->char('user_stat', 50)->nullable();
            $table->char('user_stat1', 50)->nullable();
            $table->char('user_stat2', 50)->nullable();
            $table->integer('flag_krm')->nullable();
            $table->string('finger_print', 250)->nullable();
            $table->integer('stat_scan_finger')->nullable();
            $table->char('user_edit_nasabah', 50)->nullable();
            $table->integer('flag_claim_ina')->nullable();
            $table->string('note', 100)->nullable();
            $table->string('nmRujukan', 250)->nullable();
            $table->string('alasan_batal_sep', 100)->nullable();
            $table->string('user_batal', 50)->nullable();
            $table->dateTime('tgl_jam_batal')->nullable();
            $table->string('kartu_pasien', 50)->nullable();
            $table->string('provPerujuk', 100)->nullable();
            $table->string('prolanisPRB', 100)->nullable();
            $table->string('no_hp_pendaftar', 100)->nullable();
            $table->text('uri')->nullable();
            $table->integer('flag_verif')->nullable();
            $table->integer('flag_fisio')->nullable();
            $table->integer('user_verif')->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('daftar_ol')->nullable();
            $table->integer('flag_prolanis')->nullable();
            $table->integer('userverif_ol')->nullable();
            $table->integer('flag_estetiderma')->nullable();
            $table->string('nama_agent', 50)->nullable();
            $table->string('no_mr_agent', 50)->nullable();
            $table->integer('id_get_member')->nullable();
            $table->string('email', 50)->nullable();
            $table->text('ttd')->nullable();
            $table->text('ft_sep')->nullable();
            $table->text('ft_pengantar')->nullable();
            $table->text('ft_coding')->nullable();
            $table->string('noSRK', 20)->nullable();
            $table->integer('flag_skk')->nullable();
            $table->integer('flag_skb')->nullable();
            $table->integer('flag_skd')->nullable();
            $table->integer('st_ass_dr')->nullable();
            $table->dateTime('tgl_jam_ass_dr')->nullable();
            $table->string('kode_booking', 50)->nullable();
            $table->string('no_antrian_jkn', 50)->nullable();
            $table->dateTime('tgl_verif')->nullable();
            $table->dateTime('tgl_checkin')->nullable();
            $table->integer('flag_kirim_apo')->nullable();
            $table->string('respon_addantrian', 500)->nullable();
            $table->integer('st_ass_awal')->nullable();
            $table->dateTime('tgl_jam_ass_awal')->nullable();
            $table->integer('id_user_perawat')->nullable();
            $table->integer('st_ass_awal_lanjutan')->nullable();
            $table->dateTime('tgl_jam_ass_awal_lanjutan')->nullable();
            $table->dateTime('tgl_jam_ass_awal_dr')->nullable();
            $table->integer('st_ass_dr_lanjutan')->nullable();
            $table->dateTime('tgl_jam_ass_awal_dr_lanjut')->nullable();
            $table->integer('flag_kirim')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_registrasi_temp');
    }
};
