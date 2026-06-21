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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_biaya_dr_spesialis_debet_sum_v
AS
SELECT     tahun, bulan, SUM(debet) AS debet
FROM         dbo.lap_biaya_dr_spesialis_debet_v
GROUP BY tahun, bulan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_biaya_dr_spesialis_debet_sum_v]");
    }
};
