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
        DB::statement("CREATE OR ALTER VIEW dbo.acc_saldo_awal_v
AS
SELECT     TOP (100) PERCENT dbo.master_hist_bl.acc_no, dbo.mt_account.acc_nama, dbo.master_hist_bl.saldo_awal, dbo.master_hist_bl.tahun, 
                      dbo.master_hist_bl.bulan
FROM         dbo.master_hist_bl INNER JOIN
                      dbo.mt_account ON dbo.master_hist_bl.acc_no = dbo.mt_account.acc_no
WHERE     (dbo.master_hist_bl.saldo_awal > 0) AND (dbo.master_hist_bl.tahun >= 2014)
ORDER BY dbo.master_hist_bl.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [acc_saldo_awal_v]");
    }
};
