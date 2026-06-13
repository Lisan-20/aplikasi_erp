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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_diskon_showa_v
AS
SELECT     no_registrasi, kode_perusahaan, diskon_rj, SUM(rs) AS rs, SUM(dr1) AS dr1, SUM(dr2) AS dr2, SUM(lain_lain) AS lain_lain, SUM(rs) + SUM(dr1) 
                      + SUM(dr2) + SUM(lain_lain) AS billing, CAST((SUM(rs) + SUM(dr1) + SUM(dr2) + SUM(lain_lain)) * diskon_rj / 100 AS decimal) AS diskon, no_mr
FROM         dbo.diskon_showa_v
GROUP BY no_registrasi, kode_perusahaan, diskon_rj, no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_diskon_showa_v]");
    }
};
