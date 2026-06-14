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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_gizi_kelas_sum_v
AS
SELECT     dbo.tc_gizi_kelas_view.tgl, dbo.tc_gizi_kelas_view.bln, dbo.tc_gizi_kelas_view.thn, CASE WHEN vvip IS NULL THEN 0 ELSE vvip END AS vvip, CASE WHEN vip IS NULL 
                      THEN 0 ELSE vip END AS vip, CASE WHEN kelas_I IS NULL THEN 0 ELSE kelas_I END AS kelas_I, CASE WHEN kelas_II IS NULL THEN 0 ELSE kelas_II END AS kelas_II, 
                      CASE WHEN kelas_III IS NULL THEN 0 ELSE kelas_III END AS kelas_III, dbo.tc_gizi_kelas_view.distribusi
FROM         dbo.tc_gizi_vip_view RIGHT OUTER JOIN
                      dbo.tc_gizi_kelas_view ON dbo.tc_gizi_vip_view.distribusi = dbo.tc_gizi_kelas_view.distribusi AND dbo.tc_gizi_vip_view.tgl = dbo.tc_gizi_kelas_view.tgl AND 
                      dbo.tc_gizi_vip_view.bln = dbo.tc_gizi_kelas_view.bln AND dbo.tc_gizi_vip_view.thn = dbo.tc_gizi_kelas_view.thn LEFT OUTER JOIN
                      dbo.tc_gizi_kelas_III_view ON dbo.tc_gizi_kelas_view.distribusi = dbo.tc_gizi_kelas_III_view.distribusi AND dbo.tc_gizi_kelas_view.tgl = dbo.tc_gizi_kelas_III_view.tgl AND 
                      dbo.tc_gizi_kelas_view.bln = dbo.tc_gizi_kelas_III_view.bln AND dbo.tc_gizi_kelas_view.thn = dbo.tc_gizi_kelas_III_view.thn LEFT OUTER JOIN
                      dbo.tc_gizi_kelas_II_view ON dbo.tc_gizi_kelas_view.distribusi = dbo.tc_gizi_kelas_II_view.distribusi AND dbo.tc_gizi_kelas_view.tgl = dbo.tc_gizi_kelas_II_view.tgl AND 
                      dbo.tc_gizi_kelas_view.bln = dbo.tc_gizi_kelas_II_view.bln AND dbo.tc_gizi_kelas_view.thn = dbo.tc_gizi_kelas_II_view.thn LEFT OUTER JOIN
                      dbo.tc_gizi_kelas_I_view ON dbo.tc_gizi_kelas_view.distribusi = dbo.tc_gizi_kelas_I_view.distribusi AND dbo.tc_gizi_kelas_view.tgl = dbo.tc_gizi_kelas_I_view.tgl AND 
                      dbo.tc_gizi_kelas_view.bln = dbo.tc_gizi_kelas_I_view.bln AND dbo.tc_gizi_kelas_view.thn = dbo.tc_gizi_kelas_I_view.thn LEFT OUTER JOIN
                      dbo.tc_gizi_vvip_view ON dbo.tc_gizi_kelas_view.distribusi = dbo.tc_gizi_vvip_view.distribusi AND dbo.tc_gizi_kelas_view.tgl = dbo.tc_gizi_vvip_view.tgl AND 
                      dbo.tc_gizi_kelas_view.bln = dbo.tc_gizi_vvip_view.bln AND dbo.tc_gizi_kelas_view.thn = dbo.tc_gizi_vvip_view.thn
GROUP BY dbo.tc_gizi_kelas_view.tgl, dbo.tc_gizi_kelas_view.bln, dbo.tc_gizi_kelas_view.thn, CASE WHEN vvip IS NULL THEN 0 ELSE vvip END, CASE WHEN vip IS NULL THEN 0 ELSE vip END, 
                      CASE WHEN kelas_I IS NULL THEN 0 ELSE kelas_I END, CASE WHEN kelas_II IS NULL THEN 0 ELSE kelas_II END, CASE WHEN kelas_III IS NULL THEN 0 ELSE kelas_III END, 
                      dbo.tc_gizi_kelas_view.distribusi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_gizi_kelas_sum_v]");
    }
};
