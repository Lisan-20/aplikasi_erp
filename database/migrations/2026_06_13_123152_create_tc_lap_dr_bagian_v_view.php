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
        DB::statement("CREATE VIEW dbo.tc_lap_dr_bagian_v
AS
SELECT     TOP (100) PERCENT YEAR(dbo.tc_registrasi.tgl_jam_keluar) AS thn, MONTH(dbo.tc_registrasi.tgl_jam_keluar) AS bln, DAY(dbo.tc_registrasi.tgl_jam_keluar) AS tgl, 
                      dbo.mt_master_pasien.jen_kelamin, COUNT(dbo.mt_master_pasien.jen_kelamin) AS jml_jen_kelamin, dbo.tc_registrasi.kode_kelompok, 
                      COUNT(dbo.tc_registrasi.kode_kelompok) AS jml_kode_kelompok, dbo.tc_registrasi.stat_pasien, COUNT(dbo.tc_registrasi.stat_pasien) AS jml_stat_pasien, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.umur, dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_registrasi.no_registrasi
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_registrasi ON dbo.mt_master_pasien.no_mr = dbo.tc_registrasi.no_mr
GROUP BY DAY(dbo.tc_registrasi.tgl_jam_keluar), dbo.mt_master_pasien.jen_kelamin, dbo.tc_registrasi.stat_pasien, MONTH(dbo.tc_registrasi.tgl_jam_keluar), 
                      YEAR(dbo.tc_registrasi.tgl_jam_keluar), dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.umur, 
                      dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.no_registrasi
HAVING      (dbo.tc_registrasi.status_batal IS NULL) AND (NOT (YEAR(dbo.tc_registrasi.tgl_jam_keluar) IS NULL)) AND (NOT (MONTH(dbo.tc_registrasi.tgl_jam_keluar) IS NULL)) 
                      AND (NOT (DAY(dbo.tc_registrasi.tgl_jam_keluar) IS NULL)) AND (dbo.tc_registrasi.kode_bagian_keluar IN ('030101', '030102', '030103', '030104', '030105', '030106', 
                      '030107', '030108', '030109', '030110', '030111', '030112', '030113', '030201', '030202', '030203', '030204', '030205', '030206', '030207', '030208', '030209', 
                      '030210', '030211', '030212', '030301', '030401', '030701', '030902', '031101', '031201', '031301', '031401'))
ORDER BY thn, bln, tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_lap_dr_bagian_v]");
    }
};
