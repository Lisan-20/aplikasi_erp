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
        DB::statement("CREATE OR ALTER VIEW dbo.validasi_jurnal_billing_rj_v
AS
SELECT     SUM(tx_nominal) AS billing, kode_tc_trans_kasir
FROM         dbo.tran_sed
GROUP BY flag_jurnal, kode_tc_trans_kasir
HAVING      (flag_jurnal IS NULL) AND (kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [validasi_jurnal_billing_rj_v]");
    }
};
