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
        DB::statement("CREATE OR ALTER VIEW dbo.ri_antrian_view
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.tc_kunjungan.no_kunjungan AS Expr1, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.almt_ttp_pasien, 
                      dbo.tc_kunjungan.no_registrasi, dbo.mt_master_pasien.no_ktp, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.tlp_almt_ttp, dbo.mt_karyawan.kode_dokter, 
                      dbo.mt_karyawan.nama_pegawai, dbo.tc_kunjungan.tgl_masuk AS Expr2, dbo.tc_kunjungan.tgl_keluar AS Expr3, dbo.tc_kunjungan.kode_bagian_tujuan, 
                      dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.mt_master_pasien.jen_kelamin, dbo.ri_tc_rawatinap.*, 
                      dbo.ri_tc_rawatinap.kode_ri AS Expr4
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_kunjungan ON dbo.mt_master_pasien.no_mr = dbo.tc_kunjungan.no_mr AND dbo.mt_master_pasien.no_mr = dbo.tc_kunjungan.no_mr INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_kunjungan.kode_dokter = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan
WHERE     (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_antrian_view]");
    }
};
