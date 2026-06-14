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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_siap_rujukan_v
AS
SELECT     TOP (100) PERCENT dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian AS nama_poli, dbo.mt_karyawan.nama_pegawai AS nama_dokter, 
                      dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.kode_agama, dbo.mt_master_pasien.kode_pendidikan, dbo.tc_kunjungan.no_registrasi, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_master_pasien.gol_darah, dbo.tc_kunjungan.tgl_masuk AS tgl_jam_poli, dbo.tc_kunjungan.tgl_keluar, dbo.mt_master_pasien.almt_ttp_pasien AS alamat_pasien, 
                      dbo.mt_master_pasien.nama_kel_pasien, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.mt_karyawan.no_induk AS no_induk_dokter, dbo.tc_registrasi.status_batal, 
                      dbo.tc_registrasi.noSep, dbo.tc_registrasi.kode_penanggung, dbo.tc_kunjungan.status_batal AS Expr1, dbo.Nasabah(dbo.mt_master_pasien.kode_kelompok, 
                      dbo.mt_master_pasien.kode_perusahaan) AS nasabah, dbo.tc_registrasi.stat_pasien, dbo.tc_kunjungan.status_blpl, dbo.tc_kunjungan.tgl_blpl, dbo.tc_registrasi.kode_bagian_masuk, 
                      dbo.mt_master_pasien.st_alergi, dbo.mt_master_pasien.st_resum, dbo.tc_registrasi.flag_skd, dbo.tc_registrasi.flag_skb, dbo.tc_registrasi.flag_skk, dbo.tc_registrasi.flag_skh, 
                      dbo.tc_registrasi.flag_sch, dbo.tc_registrasi.st_ass_dr_igd, dbo.tc_registrasi.st_ass_awal_fisio, dbo.tc_registrasi.st_ass_awal, dbo.tc_registrasi.st_ass_awal_lanjutan, 
                      dbo.tc_registrasi.st_ass_dr_lanjutan, dbo.tc_registrasi.st_ass_dr, dbo.tc_registrasi.st_ass_dr_gigi, dbo.tc_registrasi.st_ass_dr_gigi_lanjutan, dbo.tc_registrasi.st_ass_perawat_ANC, 
                      dbo.tc_registrasi.st_ass_perawat_PNC, dbo.tc_registrasi.st_dr_anc, dbo.tc_registrasi.st_dr_pnc, dbo.tc_registrasi.ttd, dbo.tc_registrasi.st_fisik, dbo.tc_registrasi.st_kebiasaan, 
                      dbo.tc_registrasi.saran, dbo.tc_registrasi.status_kes, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.no_kunjungan
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '01%') OR
                      (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '02%') OR
                      (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_siap_rujukan_v]");
    }
};
