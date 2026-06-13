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
        DB::statement("CREATE VIEW dbo.rm_ri_pm_pasien_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.kode_agama, 
                      dbo.mt_master_pasien.kode_pendidikan, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.gol_darah, 
                      dbo.mt_master_pasien.almt_ttp_pasien AS alamat_pasien, dbo.mt_master_pasien.nama_kel_pasien, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.noSep, dbo.tc_registrasi.kode_penanggung, MONTH(dbo.tc_kunjungan.tgl_keluar) 
                      AS bln, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, YEAR(dbo.tc_kunjungan.tgl_keluar) AS tahun, dbo.tc_registrasi.no_registrasi, 
                      dbo.tc_registrasi.no_mr, dbo.tc_kunjungan.no_kunjungan, dbo.mt_bagian.nama_bagian, dbo.tc_kunjungan.kode_bagian_tujuan, 
                      dbo.th_icd10_pasien.no_kunjungan AS Expr1, dbo.pm_tc_penunjang.kode_bagian
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_registrasi ON dbo.mt_master_pasien.no_mr = dbo.tc_registrasi.no_mr INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.pm_tc_penunjang ON dbo.tc_kunjungan.no_kunjungan = dbo.pm_tc_penunjang.no_kunjungan LEFT OUTER JOIN
                      dbo.th_icd10_pasien ON dbo.tc_kunjungan.no_kunjungan = dbo.th_icd10_pasien.no_kunjungan
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (YEAR(dbo.tc_kunjungan.tgl_keluar) >= 2015) AND (MONTH(dbo.tc_kunjungan.tgl_keluar) >= 10) AND 
                      (dbo.th_icd10_pasien.no_kunjungan IS NULL) AND (dbo.pm_tc_penunjang.kode_bagian IN ('050401', '050301'))
ORDER BY bln DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rm_ri_pm_pasien_v]");
    }
};
