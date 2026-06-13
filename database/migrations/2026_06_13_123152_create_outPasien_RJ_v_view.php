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
        DB::statement("CREATE OR ALTER VIEW dbo.outPasien_RJ_v
AS
SELECT     dbo.lap_kunjungan_igd_new_temp.tglnya, dbo.lap_kunjungan_igd_new_temp.blnnya, dbo.lap_kunjungan_igd_new_temp.thnnya, dbo.lap_kunjungan_igd_new_temp.rj_celaka, 
                      dbo.lap_kunjungan_igd_new_temp.rj_Ncelaka, CASE WHEN RJ_kecelakaan_v.jmlpas IS NULL THEN 0 ELSE RJ_kecelakaan_v.jmlpas END AS kecelakaan, 
                      CASE WHEN RJ_nonKecelakaan_v.jmlpas IS NULL THEN 0 ELSE RJ_nonKecelakaan_v.jmlpas END AS nonKecelakaan
FROM         dbo.lap_kunjungan_igd_new_temp LEFT OUTER JOIN
                      dbo.RJ_kecelakaan_v ON dbo.lap_kunjungan_igd_new_temp.tglnya = dbo.RJ_kecelakaan_v.tgl AND dbo.lap_kunjungan_igd_new_temp.blnnya = dbo.RJ_kecelakaan_v.bln AND 
                      dbo.lap_kunjungan_igd_new_temp.thnnya = dbo.RJ_kecelakaan_v.thn LEFT OUTER JOIN
                      dbo.RJ_nonKecelakaan_v ON dbo.lap_kunjungan_igd_new_temp.tglnya = dbo.RJ_nonKecelakaan_v.tgl AND dbo.lap_kunjungan_igd_new_temp.blnnya = dbo.RJ_nonKecelakaan_v.bln AND 
                      dbo.lap_kunjungan_igd_new_temp.thnnya = dbo.RJ_nonKecelakaan_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [outPasien_RJ_v]");
    }
};
