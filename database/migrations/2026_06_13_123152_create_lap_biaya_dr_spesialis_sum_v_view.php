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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_biaya_dr_spesialis_sum_v
AS
SELECT     dbo.lap_biaya_dr_spesialis_kredit_sum_v.tahun, dbo.lap_biaya_dr_spesialis_kredit_sum_v.bulan, 
                      SUM(dbo.lap_biaya_dr_spesialis_kredit_sum_v.kredit - (CASE WHEN dbo.lap_biaya_dr_spesialis_debet_sum_v.debet IS NULL THEN 0 ELSE debet END)) 
                      AS jumlah
FROM         dbo.lap_biaya_dr_spesialis_debet_sum_v LEFT OUTER JOIN
                      dbo.lap_biaya_dr_spesialis_kredit_sum_v ON dbo.lap_biaya_dr_spesialis_debet_sum_v.bulan = dbo.lap_biaya_dr_spesialis_kredit_sum_v.bulan
GROUP BY dbo.lap_biaya_dr_spesialis_kredit_sum_v.tahun, dbo.lap_biaya_dr_spesialis_kredit_sum_v.bulan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_biaya_dr_spesialis_sum_v]");
    }
};
