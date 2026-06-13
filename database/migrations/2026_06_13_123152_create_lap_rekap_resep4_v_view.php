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
        DB::statement("CREATE VIEW dbo.lap_rekap_resep4_v
AS
SELECT     dbo.lap_kunjungan_far_temp.tglnya, dbo.lap_kunjungan_far_temp.blnnya, dbo.lap_kunjungan_far_temp.thnnya, dbo.lap_kunjungan_far_temp.racikan, dbo.lap_kunjungan_far_temp.non_racikan, 
                      CASE WHEN racik IS NULL THEN 0 ELSE racik END AS racik, CASE WHEN non_racik IS NULL THEN 0 ELSE non_racik END AS non_racik
FROM         dbo.lap_kunjungan_far_temp LEFT OUTER JOIN
                      dbo.lap_rekap_resep_Nonracik_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_Nonracik_v.tgl AND 
                      dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_Nonracik_v.bln AND dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_Nonracik_v.thn LEFT OUTER JOIN
                      dbo.lap_rekap_resep_racik_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_racik_v.tgl AND dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_racik_v.bln AND 
                      dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_racik_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep4_v]");
    }
};
