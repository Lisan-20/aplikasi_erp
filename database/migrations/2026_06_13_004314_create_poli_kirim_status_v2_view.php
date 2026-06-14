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
        DB::statement("CREATE OR ALTER VIEW dbo.poli_kirim_status_v2
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian AS nama_poli, dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.mt_master_pasien.kode_agama, dbo.mt_master_pasien.kode_pendidikan, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.gol_darah, 
                      dbo.mt_master_pasien.almt_ttp_pasien AS alamat_pasien, dbo.mt_master_pasien.nik, dbo.tc_registrasi.umur, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.flag_status, CAST(RIGHT(dbo.mt_master_pasien.no_mr, 2) AS int) AS DIGIT, dbo.tc_registrasi.flag_p2d, dbo.mt_bagian.kode_bagian, dbo.tc_registrasi.tgl_jam_masuk, 
                      dbo.tc_registrasi.tgl_jam_masuk AS tgl_jam_poli, dbo.tc_registrasi.no_mr AS Expr1, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.no_registrasi, dbo.mt_master_pasien.no_mr, 
                      dbo.tc_registrasi.stat_pasien
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.mt_bagian.kode_bagian LIKE '01%') AND (NOT (dbo.tc_registrasi.no_mr LIKE '%L%')) OR
                      (dbo.mt_bagian.kode_bagian LIKE '020101%') OR
                      (dbo.mt_bagian.kode_bagian LIKE '050301%') OR
                      (dbo.mt_bagian.kode_bagian LIKE '050401%') OR
                      (dbo.mt_bagian.kode_bagian LIKE '030601%') OR
                      (dbo.mt_bagian.kode_bagian LIKE '030701%') OR
                      (dbo.mt_bagian.kode_bagian LIKE '050101%') OR
                      (dbo.mt_bagian.kode_bagian LIKE '050201%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [poli_kirim_status_v2]");
    }
};
