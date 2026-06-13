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
        DB::statement("CREATE VIEW dbo.pl_mt_pasien2nd_v
AS
SELECT     TOP (100) PERCENT dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.kode_agama, 
                      dbo.mt_master_pasien.kode_pendidikan, dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan, dbo.tc_kunjungan.no_registrasi, 
                      dbo.mt_master_pasien.gol_darah, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.nama_pegawai, 
                      dbo.mt_bagian.kode_bagian, dbo.tc_kunjungan.status_keluar, dbo.mt_karyawan.kode_dokter, dbo.tc_kunjungan.no_kunjungan, dbo.pl_tc_poli.kode_poli
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_kunjungan ON dbo.mt_master_pasien.no_mr = dbo.tc_kunjungan.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.pl_tc_poli ON dbo.tc_kunjungan.no_kunjungan = dbo.pl_tc_poli.no_kunjungan LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_kunjungan.kode_dokter = dbo.mt_karyawan.kode_dokter
GROUP BY dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.kode_agama, 
                      dbo.mt_master_pasien.kode_pendidikan, dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan, dbo.tc_kunjungan.no_registrasi, 
                      dbo.mt_master_pasien.gol_darah, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.nama_pegawai, 
                      dbo.mt_bagian.kode_bagian, dbo.tc_kunjungan.status_keluar, dbo.mt_karyawan.kode_dokter, dbo.tc_kunjungan.no_kunjungan, dbo.pl_tc_poli.kode_poli
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pl_mt_pasien2nd_v]");
    }
};
