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
        DB::statement("CREATE VIEW dbo.hitung_hari_rawat_sum_v
AS
SELECT     TOP (100) PERCENT bulan, tahun, SUM(hari_rawat) AS hari_rawat
FROM         dbo.hitung_hari_rawat_v
GROUP BY bulan, tahun
ORDER BY bulan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hitung_hari_rawat_sum_v]");
    }
};
