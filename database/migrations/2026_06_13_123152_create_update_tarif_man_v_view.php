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
        DB::statement("CREATE VIEW dbo.update_tarif_man_v
AS
SELECT     TOP (100) PERCENT bill_rs, bill_dr1, CAST(bill_rs + bill_dr1 AS varchar) AS kriting, bill_rs - 1 AS bill_upd
FROM         dbo.mt_master_tarif_detail
WHERE     (CAST(bill_rs + bill_dr1 AS varchar) LIKE '%02')
ORDER BY CAST(bill_rs + bill_dr1 AS varchar)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_tarif_man_v]");
    }
};
