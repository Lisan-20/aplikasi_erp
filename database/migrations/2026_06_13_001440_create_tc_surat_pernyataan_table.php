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
        if (Schema::hasTable('tc_surat_pernyataan')) {
            return;
        }

        Schema::create('tc_surat_pernyataan', function (Blueprint $table) {
            $table->increments('id_surat');
            $table->string('no_mr', 8)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->dateTime('tgl_surat')->nullable();
            $table->string('nama_wali', 250)->nullable();
            $table->string('jen_kelamin', 250)->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_tlp', 250)->nullable();
            $table->string('hub_kel', 250)->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->text('ttd_wali')->nullable();
            $table->string('umur_wali', 250)->nullable();
            $table->string('umur_pasien', 250)->nullable();
            $table->text('alasan_aps')->nullable();
            $table->string('tx_penyakit', 250)->nullable();
            $table->string('tx_rs_rujuk', 250)->nullable();
            $table->string('tx_dirawat', 250)->nullable();
            $table->string('dokter2', 250)->nullable();
            $table->string('secon2', 250)->nullable();
            $table->text('alasan_tolak_ri')->nullable();
            $table->string('hubungan_wali2', 250)->nullable();
            $table->text('ket_mata_kiri')->nullable();
            $table->text('ket_mata_kanan')->nullable();
            $table->string('mata_kiri', 250)->nullable();
            $table->string('mata_kanan', 250)->nullable();
            $table->string('penglihatan', 250)->nullable();
            $table->text('catatan')->nullable();
            $table->string('nama_pengirim_jen', 250)->nullable();
            $table->string('jabatan', 250)->nullable();
            $table->string('ruangan', 250)->nullable();
            $table->string('nama_penerima_jen', 250)->nullable();
            $table->string('jabatan2', 250)->nullable();
            $table->string('jam_meninggal', 250)->nullable();
            $table->string('jam_terima', 250)->nullable();
            $table->string('asal', 250)->nullable();
            $table->text('lokalis')->nullable();
            $table->string('fikrasi', 250)->nullable();
            $table->text('diagnosa_klinik')->nullable();
            $table->text('keterangan_klinik')->nullable();
            $table->string('patoligi_di', 250)->nullable();
            $table->string('tanggal_pa', 250)->nullable();
            $table->string('nomor', 250)->nullable();
            $table->string('diagnosa2', 250)->nullable();
            $table->text('diag_pembedahan')->nullable();
            $table->text('ren_tindakan')->nullable();
            $table->text('prognosis')->nullable();
            $table->text('alternatif')->nullable();
            $table->text('ren_analgetik')->nullable();
            $table->text('ttd_pasien')->nullable();
            $table->text('ttd_dpjp_anestesi')->nullable();
            $table->string('tx_jatah_kelas', 50)->nullable();
            $table->string('tx_naik_kelas', 50)->nullable();
            $table->text('diagnosis_dpjp')->nullable();
            $table->text('diagnosis_konsul')->nullable();
            $table->text('pengobatan')->nullable();
            $table->text('berhubungan')->nullable();
            $table->text('txt_berhubungan')->nullable();
            $table->text('alasan')->nullable();
            $table->text('ttd_ri')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('nama_ibu', 250)->nullable();
            $table->integer('kode_dr')->nullable();
            $table->string('saksi_pasien', 250)->nullable();
            $table->text('ttd_saksi_pasien')->nullable();
            $table->dateTime('tgl_ttd_saksi_pasien')->nullable();
            $table->integer('saksi_rs')->nullable();
            $table->text('lain_lain')->nullable();
            $table->string('no_ktp_wali', 50)->nullable();
            $table->string('setuju', 50)->nullable();
            $table->string('jenis_transfusi', 50)->nullable();
            $table->string('persetujuan', 250)->nullable();
            $table->integer('txt_anes')->nullable();
            $table->string('nik_wali', 250)->nullable();
            $table->string('tgl_kejadian', 250)->nullable();
            $table->string('waktu_kejadian', 250)->nullable();
            $table->string('penjamin', 250)->nullable();
            $table->string('kendaraan', 250)->nullable();
            $table->string('lainnya', 250)->nullable();
            $table->string('pasien_sebagai', 250)->nullable();
            $table->string('sim', 250)->nullable();
            $table->text('krologogis')->nullable();
            $table->string('lokasi_kejadian', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_surat_pernyataan');
    }
};
