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
        DB::statement("CREATE VIEW dbo.pl_mt_surat_pasien_v
AS
SELECT     TOP (100) PERCENT dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.mt_master_pasien.kode_agama, dbo.mt_master_pasien.kode_pendidikan, dbo.tc_kunjungan.no_registrasi, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.gol_darah, 
                      dbo.tc_kunjungan.tgl_masuk AS tgl_jam_poli, dbo.tc_kunjungan.tgl_keluar, dbo.mt_master_pasien.almt_ttp_pasien AS alamat_pasien, dbo.mt_master_pasien.nama_kel_pasien, 
                      dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.noSep, dbo.tc_registrasi.kode_penanggung, 
                      dbo.tc_kunjungan.status_batal AS Expr1, dbo.Nasabah(dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan) AS nasabah, dbo.tc_registrasi.stat_pasien, 
                      dbo.tc_registrasi.st_ass_dr_gigi_lanjutan, dbo.tc_registrasi.st_ass_dr_gigi, dbo.tc_registrasi.st_ass_awal_lanjutan, dbo.tc_registrasi.flag_skd, dbo.tc_registrasi.flag_skb, 
                      dbo.tc_registrasi.flag_skk, dbo.tc_registrasi.st_ass_dr_lanjutan, dbo.tc_registrasi.st_ass_dr, dbo.tc_registrasi.tgl_jam_ass_awal, dbo.tc_registrasi.ttd, dbo.tc_registrasi.st_ass_awal, 
                      dbo.tc_registrasi.ft_coding, dbo.tc_registrasi.ft_pengantar, dbo.tc_registrasi.ft_sep, dbo.tc_registrasi.flag_info, dbo.tc_registrasi.umur, dbo.tc_registrasi.flag_skh, dbo.tc_registrasi.flag_sch, 
                      dbo.tc_registrasi.info_1, dbo.tc_registrasi.info_2, dbo.tc_registrasi.tgl_jam_masuk, dbo.mt_bagian.nama_bagian AS nama_poli, dbo.tc_registrasi.kode_dokter
FROM         dbo.mt_bagian INNER JOIN
                      dbo.tc_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi ON dbo.mt_bagian.kode_bagian = dbo.tc_registrasi.kode_bagian_masuk INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pl_mt_surat_pasien_v]");
    }
};
