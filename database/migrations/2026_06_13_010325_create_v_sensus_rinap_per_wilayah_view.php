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
        DB::statement("CREATE OR ALTER VIEW dbo.v_sensus_rinap_per_wilayah
AS
SELECT     dbo.mt_master_pasien.id_dc_kecamatan, dbo.dc_kecamatan.nama_kecamatan, dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, 
                      dbo.tc_kunjungan.kode_dokter, dbo.tc_kunjungan.kode_bagian_tujuan AS kode_bagian, dbo.tc_kunjungan.tgl_masuk, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan, DAY(dbo.tc_kunjungan.tgl_keluar) AS tgl, MONTH(dbo.tc_kunjungan.tgl_keluar) 
                      AS bln, YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.nama_pegawai AS dokter, 
                      dbo.mt_master_pasien.jen_kelamin AS kelamin, dbo.tc_registrasi.stat_pasien, dbo.tc_registrasi.umur, dbo.dc_asal_pasien.asal_pasien, 
                      dbo.tc_registrasi.id_dc_asal_pasien, dbo.tc_kunjungan.tgl_keluar
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.dc_kecamatan ON dbo.mt_master_pasien.id_dc_kecamatan = dbo.dc_kecamatan.id_dc_kecamatan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.dc_asal_pasien ON dbo.tc_registrasi.id_dc_asal_pasien = dbo.dc_asal_pasien.id_dc_asal_pasien LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_kunjungan.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (NOT (dbo.tc_kunjungan.tgl_keluar IS NULL)) AND (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sensus_rinap_per_wilayah]");
    }
};
