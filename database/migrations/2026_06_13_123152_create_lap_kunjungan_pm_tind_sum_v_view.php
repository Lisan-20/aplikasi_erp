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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_pm_tind_sum_v
AS
SELECT     referensi, SUM(JmlTind) AS JmlTind, tgl, bln, thn, kode_bagian
FROM         dbo.lap_kunjungan_pm_tind_v
GROUP BY referensi, tgl, bln, thn, kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pm_tind_sum_v]");
    }
};
