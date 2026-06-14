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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_igd_LP_all_v
AS
SELECT     dbo.lap_kunjungan_igd_new_temp.tglnya, dbo.lap_kunjungan_igd_new_temp.blnnya, dbo.lap_kunjungan_igd_new_temp.thnnya, 
                      dbo.lap_kunjungan_igd_new_temp.ank_laki, dbo.lap_kunjungan_igd_new_temp.ank_prmp, dbo.lap_kunjungan_igd_new_temp.dws_laki, 
                      dbo.lap_kunjungan_igd_new_temp.dws_prmp, CASE WHEN lap_kunjungan_igd_dwsP_v.jmlPas IS NULL 
                      THEN 0 ELSE lap_kunjungan_igd_dwsP_v.jmlPas END AS dws_prmp1, CASE WHEN lap_kunjungan_igd_dwsL_v.jmlPas IS NULL 
                      THEN 0 ELSE lap_kunjungan_igd_dwsL_v.jmlPas END AS dws_laki1, CASE WHEN lap_kunjungan_igd_ankL_v.jmlPas IS NULL 
                      THEN 0 ELSE lap_kunjungan_igd_ankL_v.jmlPas END AS ank_laki1, CASE WHEN lap_kunjungan_igd_ankP_v.jmlPas IS NULL 
                      THEN 0 ELSE lap_kunjungan_igd_ankP_v.jmlPas END AS ank_prmp1
FROM         dbo.lap_kunjungan_igd_dwsP_v RIGHT OUTER JOIN
                      dbo.lap_kunjungan_igd_new_temp LEFT OUTER JOIN
                      dbo.lap_kunjungan_igd_ankP_v ON dbo.lap_kunjungan_igd_new_temp.tglnya = dbo.lap_kunjungan_igd_ankP_v.tgl AND 
                      dbo.lap_kunjungan_igd_new_temp.blnnya = dbo.lap_kunjungan_igd_ankP_v.bln AND 
                      dbo.lap_kunjungan_igd_new_temp.thnnya = dbo.lap_kunjungan_igd_ankP_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_igd_ankL_v ON dbo.lap_kunjungan_igd_new_temp.tglnya = dbo.lap_kunjungan_igd_ankL_v.tgl AND 
                      dbo.lap_kunjungan_igd_new_temp.blnnya = dbo.lap_kunjungan_igd_ankL_v.bln AND 
                      dbo.lap_kunjungan_igd_new_temp.thnnya = dbo.lap_kunjungan_igd_ankL_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_igd_dwsL_v ON dbo.lap_kunjungan_igd_new_temp.tglnya = dbo.lap_kunjungan_igd_dwsL_v.tgl AND 
                      dbo.lap_kunjungan_igd_new_temp.blnnya = dbo.lap_kunjungan_igd_dwsL_v.bln AND 
                      dbo.lap_kunjungan_igd_new_temp.thnnya = dbo.lap_kunjungan_igd_dwsL_v.thn ON 
                      dbo.lap_kunjungan_igd_dwsP_v.tgl = dbo.lap_kunjungan_igd_new_temp.tglnya AND 
                      dbo.lap_kunjungan_igd_dwsP_v.bln = dbo.lap_kunjungan_igd_new_temp.blnnya AND dbo.lap_kunjungan_igd_dwsP_v.thn = dbo.lap_kunjungan_igd_new_temp.thnnya
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_igd_LP_all_v]");
    }
};
