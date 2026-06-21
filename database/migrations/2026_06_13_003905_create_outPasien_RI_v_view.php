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
        DB::statement("CREATE OR ALTER VIEW dbo.outPasien_RI_v
AS
SELECT     dbo.lap_kunjungan_igd_new_temp.tglnya, dbo.lap_kunjungan_igd_new_temp.blnnya, dbo.lap_kunjungan_igd_new_temp.thnnya, dbo.lap_kunjungan_igd_new_temp.ri_celaka, 
                      dbo.lap_kunjungan_igd_new_temp.ri_Ncelaka, CASE WHEN RI_kecelakaan_v.jmlpas IS NULL THEN 0 ELSE RI_kecelakaan_v.jmlpas END AS kecelakaan, 
                      CASE WHEN RI_nonKecelakaan_v.jmlpas IS NULL THEN 0 ELSE RI_nonKecelakaan_v.jmlpas END AS nonKecelakaan
FROM         dbo.lap_kunjungan_igd_new_temp LEFT OUTER JOIN
                      dbo.RI_kecelakaan_v ON dbo.lap_kunjungan_igd_new_temp.tglnya = dbo.RI_kecelakaan_v.tgl AND dbo.lap_kunjungan_igd_new_temp.blnnya = dbo.RI_kecelakaan_v.bln AND 
                      dbo.lap_kunjungan_igd_new_temp.thnnya = dbo.RI_kecelakaan_v.thn LEFT OUTER JOIN
                      dbo.RI_nonKecelakaan_v ON dbo.lap_kunjungan_igd_new_temp.tglnya = dbo.RI_nonKecelakaan_v.tgl AND dbo.lap_kunjungan_igd_new_temp.blnnya = dbo.RI_nonKecelakaan_v.bln AND 
                      dbo.lap_kunjungan_igd_new_temp.thnnya = dbo.RI_nonKecelakaan_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [outPasien_RI_v]");
    }
};
