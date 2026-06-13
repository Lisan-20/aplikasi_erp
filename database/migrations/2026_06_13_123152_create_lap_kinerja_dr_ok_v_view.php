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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kinerja_dr_ok_v
AS
SELECT     TOP (100) PERCENT YEAR(dbo.tc_registrasi.tgl_jam_keluar) AS thn, MONTH(dbo.tc_registrasi.tgl_jam_keluar) AS bln, DAY(dbo.tc_registrasi.tgl_jam_keluar) AS tgl, 
                      dbo.mt_master_pasien.jen_kelamin, COUNT(dbo.mt_master_pasien.jen_kelamin) AS jml_jen_kelamin, dbo.tc_registrasi.kode_kelompok, 
                      COUNT(dbo.tc_registrasi.kode_kelompok) AS jml_kode_kelompok, dbo.tc_registrasi.stat_pasien, COUNT(dbo.tc_registrasi.stat_pasien) AS jml_stat_pasien, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.umur, dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.no_mr, dbo.tc_kunjungan.no_kunjungan, dbo.tc_registrasi.tgl_jam_masuk, 
                      dbo.tc_registrasi.tgl_jam_keluar
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
GROUP BY DAY(dbo.tc_registrasi.tgl_jam_keluar), dbo.mt_master_pasien.jen_kelamin, dbo.tc_registrasi.stat_pasien, MONTH(dbo.tc_registrasi.tgl_jam_keluar), 
                      YEAR(dbo.tc_registrasi.tgl_jam_keluar), dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.umur, 
                      dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.no_mr, 
                      dbo.tc_kunjungan.no_kunjungan, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar
HAVING      (dbo.tc_kunjungan.kode_bagian_tujuan = '030901') AND (dbo.tc_registrasi.status_batal IS NULL) AND (NOT (YEAR(dbo.tc_registrasi.tgl_jam_keluar) IS NULL)) AND 
                      (NOT (MONTH(dbo.tc_registrasi.tgl_jam_keluar) IS NULL)) AND (NOT (DAY(dbo.tc_registrasi.tgl_jam_keluar) IS NULL))
ORDER BY thn, bln, tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kinerja_dr_ok_v]");
    }
};
