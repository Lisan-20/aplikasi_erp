<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE OR ALTER VIEW dbo.monitoring_taskid_rj_pasien_v
AS
SELECT     TOP (100) PERCENT dbo.pl_tc_poli.id_pl_tc_poli, dbo.pl_tc_poli.kode_poli, dbo.pl_tc_poli.no_kunjungan, dbo.pl_tc_poli.kode_bagian, dbo.pl_tc_poli.no_antrian, dbo.pl_tc_poli.tgl_jam_poli, 
                      dbo.pl_tc_poli.kode_dokter, dbo.pl_tc_poli.kode_resep, dbo.pl_tc_poli.kode_gcu, dbo.pl_tc_poli.status_periksa, dbo.pl_tc_poli.no_induk, dbo.tc_kunjungan.no_mr, 
                      dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian AS nama_poli, dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.mt_master_pasien.kode_agama, dbo.mt_master_pasien.kode_pendidikan, dbo.tc_kunjungan.no_registrasi, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.gol_darah, 
                      dbo.tc_kunjungan.tgl_masuk AS xx, dbo.tc_kunjungan.tgl_keluar, dbo.pl_tc_poli.kode_bagian AS kode_bagian_poli, dbo.mt_master_pasien.almt_ttp_pasien AS alamat_pasien, 
                      dbo.mt_master_pasien.nama_kel_pasien, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.mt_karyawan.no_induk AS no_induk_dokter, dbo.pl_tc_poli.kode_jadwal, 
                      dbo.pl_tc_poli.status_isihasil, dbo.tc_registrasi.noSep, dbo.tc_registrasi.noKartuPeserta, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.flag_verif, dbo.mt_nasabah.nama_kelompok, 
                      CONVERT(VARCHAR(10), dbo.tc_registrasi.tgl_jam_masuk, 105) AS tgl_masuk, CASE WHEN daftar_ol NOT IN (1, 15) THEN 2 WHEN daftar_ol IS NULL THEN 2 ELSE daftar_ol END AS daftar_ol, 
                      dbo.tc_registrasi.daftar_ol AS Expr2, dbo.pl_tc_poli.id_mt_jadwal_dokter, dbo.pl_tc_poli.jam_praktek AS jam_praktek_poli, dbo.tc_registrasi.flag_prolanis, dbo.pl_tc_poli.no_antrian_umum, 
                      dbo.pl_tc_poli.status_panggil, dbo.pl_tc_poli.status_keluar, dbo.mt_bagian.kode_poli_vclaim, dbo.tc_registrasi.kode_booking, dbo.pl_tc_poli.tgl_jam_panggil, 
                      dbo.pl_tc_poli.tgl_jam_keluar AS tgl_jam_keluar_poli, dbo.tc_registrasi.respon_addantrian, dbo.tc_registrasi.no_reg_inap, dbo.tc_registrasi.flag_wa, dbo.tc_registrasi.ttd, dbo.tc_registrasi.st_fisik, 
                      dbo.tc_registrasi.st_kebiasaan, dbo.tc_registrasi.id_resum, dbo.tc_registrasi.st_riwayat, dbo.tc_registrasi.st_lab, dbo.tc_registrasi.tgl_hadir, dbo.tc_registrasi.st_ass_awal, 
                      dbo.tc_registrasi.st_ass_awal_lanjutan, dbo.tc_registrasi.st_ass_dr, dbo.tc_registrasi.st_ass_dr_lanjutan, dbo.tc_registrasi.st_ass_dr_gigi, dbo.tc_registrasi.st_ass_dr_gigi_lanjutan, 
                      dbo.tc_registrasi.st_ass_perawat_ANC, dbo.tc_registrasi.st_ass_perawat_PNC, dbo.tc_registrasi.st_dr_anc, dbo.tc_registrasi.st_dr_pnc, dbo.tc_registrasi.flag_skd, dbo.tc_registrasi.flag_skb, 
                      dbo.tc_registrasi.flag_skk, dbo.tc_registrasi.ft_coding, dbo.tc_registrasi.ft_pengantar, dbo.tc_registrasi.ft_sep, dbo.tc_registrasi.flag_info, dbo.tc_registrasi.flag_skh, dbo.tc_registrasi.flag_sch, 
                      dbo.tc_registrasi.info_1, dbo.tc_registrasi.info_2, dbo.tc_registrasi.st_ass_dr_igd, dbo.tc_registrasi.st_ass_awal_fisio, dbo.tc_registrasi.st_ass_inv_fisio, dbo.tc_registrasi.st_ass_awal_hemo, 
                      dbo.tc_registrasi.st_ass_inv_hemo, dbo.tc_registrasi.id_user_inv_hemo, dbo.tc_registrasi.st_ass_plk_hemo, dbo.tc_registrasi.st_usg, dbo.mt_master_pasien.st_resum, 
                      dbo.mt_master_pasien.st_alergi, dbo.tc_kunjungan.status_batal AS Expr1, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.st_ass_luar, dbo.tc_registrasi.st_ass_dis, dbo.mt_master_pasien.no_ktp, 
                      dbo.tc_registrasi.st_ass_ogbyn, dbo.tc_registrasi.flag_daftar, dbo.tc_registrasi.noRujukan, dbo.tc_kunjungan.status_blpl
FROM         dbo.pl_tc_poli INNER JOIN
                      dbo.tc_kunjungan ON dbo.pl_tc_poli.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.pl_tc_poli.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_nasabah ON dbo.mt_master_pasien.kode_kelompok = dbo.mt_nasabah.kode_kelompok LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.pl_tc_poli.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_kunjungan.status_batal IS NULL)
ORDER BY dbo.pl_tc_poli.kode_bagian, dbo.pl_tc_poli.no_antrian, dbo.pl_tc_poli.tgl_jam_poli DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [monitoring_taskid_rj_pasien_v]");
    }
};
