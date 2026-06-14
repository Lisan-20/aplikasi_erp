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
        DB::statement("CREATE OR ALTER VIEW dbo.sum_sum_bill_sktm_v
AS
SELECT     NAMA, SUM(lain_lain) AS Expr1, SUBSTRING(KOBAG, 1, 2) AS Expr2
FROM         dbo.SUM_BILL_PASIEN_SKTM_V
GROUP BY NAMA, SUBSTRING(KOBAG, 1, 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_sum_bill_sktm_v]");
    }
};
