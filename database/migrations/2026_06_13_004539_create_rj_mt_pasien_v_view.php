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
        DB::statement("CREATE OR ALTER VIEW dbo.rj_mt_pasien_v
AS
SELECT     TOP (100) PERCENT dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.kode_agama, dbo.mt_master_pasien.kode_pendidikan, 
                      dbo.tc_kunjungan.no_registrasi, dbo.mt_master_pasien.gol_darah, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.nama_pegawai, 
                      dbo.mt_bagian.kode_bagian, dbo.tc_kunjungan.status_keluar, dbo.mt_karyawan.kode_dokter, dbo.tc_kunjungan.no_kunjungan, dbo.gd_tc_gawat_darurat.kode_gd, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_kunjungan.status_batal, YEAR(dbo.tc_kunjungan.tgl_masuk) AS Expr1
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_kunjungan ON dbo.mt_master_pasien.no_mr = dbo.tc_kunjungan.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi AND dbo.tc_kunjungan.no_mr = dbo.tc_registrasi.no_mr LEFT OUTER JOIN
                      dbo.gd_tc_gawat_darurat ON dbo.tc_kunjungan.no_kunjungan = dbo.gd_tc_gawat_darurat.no_kunjungan LEFT OUTER JOIN
                      dbo.pl_tc_poli ON dbo.tc_kunjungan.no_kunjungan = dbo.pl_tc_poli.no_kunjungan LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_kunjungan.kode_dokter = dbo.mt_karyawan.kode_dokter
GROUP BY dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.kode_agama, dbo.mt_master_pasien.kode_pendidikan, 
                      dbo.tc_kunjungan.no_registrasi, dbo.mt_master_pasien.gol_darah, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.nama_pegawai, 
                      dbo.mt_bagian.kode_bagian, dbo.tc_kunjungan.status_keluar, dbo.mt_karyawan.kode_dokter, dbo.tc_kunjungan.no_kunjungan, dbo.gd_tc_gawat_darurat.kode_gd, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_kunjungan.status_batal, YEAR(dbo.tc_kunjungan.tgl_masuk)
HAVING      (dbo.tc_kunjungan.status_batal IS NULL) AND (YEAR(dbo.tc_kunjungan.tgl_masuk) >= 2016)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rj_mt_pasien_v]");
    }
};
