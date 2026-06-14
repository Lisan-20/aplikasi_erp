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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_acc_no_ht_dokter
AS
SELECT     dbo.tx_harian.no_bukti, dbo.tx_harian.acc_no, dbo.bd_tc_hutang_dr.no_bukti AS Expr1, dbo.bd_tc_hutang_dr.rj_ri, dbo.mt_account.acc_nama
FROM         dbo.bd_tc_hutang_dr INNER JOIN
                      dbo.tx_harian ON dbo.bd_tc_hutang_dr.no_bukti = dbo.tx_harian.no_bukti INNER JOIN
                      dbo.mt_account ON dbo.tx_harian.acc_no = dbo.mt_account.acc_no
WHERE     (dbo.bd_tc_hutang_dr.rj_ri = 'RI') AND (dbo.tx_harian.acc_no = 2110504)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_acc_no_ht_dokter]");
    }
};
