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
        DB::statement("CREATE OR ALTER VIEW dbo.rm_gd_daftar_antrian_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.no_mr, dbo.tc_kunjungan.no_kunjungan, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.almt_ttp_pasien, dbo.tc_kunjungan.no_registrasi, 
                      dbo.gd_tc_gawat_darurat.kode_gd, dbo.mt_master_pasien.no_ktp, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.tlp_almt_ttp, dbo.mt_karyawan.kode_dokter, 
                      dbo.mt_karyawan.nama_pegawai, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.mt_master_pasien.jen_kelamin, dbo.gd_tc_gawat_darurat.no_induk, dbo.tc_kunjungan.status_batal, dbo.tc_registrasi.kode_penanggung, 
                      dbo.th_icd10_pasien.kode_icd, YEAR(dbo.tc_kunjungan.tgl_masuk) AS Expr1, dbo.gd_tc_gawat_darurat.kode_bagian
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_kunjungan ON dbo.mt_master_pasien.no_mr = dbo.tc_kunjungan.no_mr AND dbo.mt_master_pasien.no_mr = dbo.tc_kunjungan.no_mr INNER JOIN
                      dbo.gd_tc_gawat_darurat ON dbo.tc_kunjungan.no_kunjungan = dbo.gd_tc_gawat_darurat.no_kunjungan INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_kunjungan.kode_dokter = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi LEFT OUTER JOIN
                      dbo.th_icd10_pasien ON dbo.tc_registrasi.no_registrasi = dbo.th_icd10_pasien.no_registrasi
WHERE     (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '02%') AND (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.th_icd10_pasien.kode_icd IS NULL) AND 
                      (YEAR(dbo.tc_kunjungan.tgl_masuk) >= 2015)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rm_gd_daftar_antrian_v]");
    }
};
