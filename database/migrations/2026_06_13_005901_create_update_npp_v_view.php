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
        DB::statement("CREATE OR ALTER VIEW dbo.update_npp_v
AS
SELECT     dbo.tc_transaksi_payroll.id_tc_trans, dbo.tc_transaksi_payroll.npp_old, tc_transaksi_payroll_1.npp
FROM         dbo.tc_transaksi_payroll INNER JOIN
                      dbo.tc_transaksi_payroll AS tc_transaksi_payroll_1 ON dbo.tc_transaksi_payroll.id_tc_trans = tc_transaksi_payroll_1.id_tc_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_npp_v]");
    }
};
