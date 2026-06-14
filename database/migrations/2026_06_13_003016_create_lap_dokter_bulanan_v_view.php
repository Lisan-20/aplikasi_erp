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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_dokter_bulanan_v
AS
SELECT        TOP (100) PERCENT YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, DAY(dbo.tc_kunjungan.tgl_keluar) AS tgl, 
                         dbo.mt_master_pasien.jen_kelamin, COUNT(dbo.mt_master_pasien.jen_kelamin) AS jml_jen_kelamin, dbo.tc_registrasi.kode_kelompok, 
                         COUNT(dbo.tc_registrasi.kode_kelompok) AS jml_kode_kelompok, dbo.tc_registrasi.stat_pasien, COUNT(dbo.tc_registrasi.stat_pasien) AS jml_stat_pasien, 
                         dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.umur, dbo.tc_kunjungan.kode_dokter, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.no_kunjungan, 
                         dbo.tc_kunjungan.no_registrasi, dbo.mt_perusahaan.flag_kapitasi, dbo.mt_master_pasien.no_mr, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, 
                         dbo.ri_tc_rawatinap.kelas_pas
FROM            dbo.tc_kunjungan INNER JOIN
                         dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                         dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                         dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan LEFT OUTER JOIN
                         dbo.mt_perusahaan ON dbo.tc_registrasi.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
GROUP BY DAY(dbo.tc_kunjungan.tgl_keluar), dbo.mt_master_pasien.jen_kelamin, dbo.tc_registrasi.stat_pasien, MONTH(dbo.tc_kunjungan.tgl_keluar), 
                         YEAR(dbo.tc_kunjungan.tgl_keluar), dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.umur, dbo.tc_kunjungan.kode_dokter, 
                         dbo.tc_kunjungan.status_batal, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.no_registrasi, 
                         dbo.mt_perusahaan.flag_kapitasi, dbo.tc_registrasi.status_batal, dbo.mt_master_pasien.no_mr, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, 
                         dbo.ri_tc_rawatinap.kelas_pas
HAVING        (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_dokter_bulanan_v]");
    }
};
