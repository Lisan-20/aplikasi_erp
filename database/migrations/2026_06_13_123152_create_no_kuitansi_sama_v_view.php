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
        DB::statement("CREATE OR ALTER VIEW dbo.no_kuitansi_sama_v
AS
SELECT     TOP (100) PERCENT no_kuitansi, seri_kuitansi, COUNT(kode_tc_trans_kasir) AS jml, kode_tc_trans_kasir
FROM         dbo.tc_trans_kasir
WHERE     (no_kuitansi IS NULL)
GROUP BY seri_kuitansi, no_kuitansi, kode_tc_trans_kasir
ORDER BY no_kuitansi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [no_kuitansi_sama_v]");
    }
};
