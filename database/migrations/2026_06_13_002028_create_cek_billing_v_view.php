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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_billing_v
AS
SELECT     SUM(bill_rs) + SUM(bill_dr1) + SUM(bill_dr2) AS billing, kode_tc_trans_kasir
FROM         dbo.tc_trans_pelayanan
WHERE     (flag_jurnal = 0)
GROUP BY kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_billing_v]");
    }
};
