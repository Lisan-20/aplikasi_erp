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
        DB::statement("CREATE OR ALTER VIEW dbo.shift3_absensi_v
AS
SELECT     TOP (100) PERCENT dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.st_shift, dbo.tc_absensi.npp, dbo.ks_mt_shift.kode_shift, YEAR(dbo.tc_absensi.jam_masuk) AS tahun, 
                      REPLACE(CONVERT(varchar, dbo.tc_absensi.jam_masuk, 108), ':', '') AS jam_masuk, REPLACE(CONVERT(varchar, dbo.ks_mt_shift.dari_jam, 108), ':', '') AS dari_jam, CONVERT(varchar, 
                      dbo.tc_absensi.jam_masuk, 108) AS Expr2, dbo.ks_mt_shift.dari_jam AS Expr3, DATEDIFF(MINUTE, dbo.ks_mt_shift.dari_jam, CONVERT(varchar, dbo.tc_absensi.jam_masuk, 108)) 
                      AS selisih_waktu, dbo.ks_mt_shift.range_waktu_awal, dbo.ks_mt_shift.range_waktu_akhir, CONVERT(varchar, dbo.tc_absensi.jam_masuk, 108) AS range_waktu, dbo.tc_absensi.tgl_absensi
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.tc_absensi ON dbo.mt_karyawan.npp = dbo.tc_absensi.npp CROSS JOIN
                      dbo.ks_mt_shift
WHERE     (dbo.tc_absensi.npp <> '') AND (dbo.ks_mt_shift.kode_shift = 3) AND (YEAR(dbo.tc_absensi.jam_masuk) = 2022) AND (dbo.mt_karyawan.st_shift = 2) AND (DATEDIFF(MINUTE, 
                      dbo.ks_mt_shift.dari_jam, CONVERT(varchar, dbo.tc_absensi.jam_masuk, 108)) > 0) AND (CONVERT(varchar, dbo.tc_absensi.jam_masuk, 108) BETWEEN dbo.ks_mt_shift.range_waktu_awal AND 
                      dbo.ks_mt_shift.range_waktu_akhir)
ORDER BY selisih_waktu
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [shift3_absensi_v]");
    }
};
