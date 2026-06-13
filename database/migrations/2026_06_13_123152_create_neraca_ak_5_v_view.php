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
        DB::statement("CREATE OR ALTER VIEW dbo.neraca_ak_5_v
AS
SELECT     TOP (100) PERCENT dbo.mt_account.acc_no, dbo.mt_account.acc_nama, dbo.mt_account.level_coa, dbo.mt_account.acc_type, dbo.mt_account.referensi, 
                      dbo.master_hist_bl.tahun, dbo.master_hist_bl.bulan, dbo.master_hist_bl.mutasi_d, dbo.master_hist_bl.mutasi_k, dbo.master_hist_bl.saldo_awal, 
                      dbo.master_hist_bl.saldo_akhir, dbo.master_hist_bl.flag, dbo.master_hist_bl.ko_wil
FROM         dbo.mt_account INNER JOIN
                      dbo.master_hist_bl ON dbo.mt_account.acc_no = dbo.master_hist_bl.acc_no AND dbo.mt_account.level_coa = dbo.master_hist_bl.[level]
WHERE     (dbo.mt_account.level_coa = 5)
ORDER BY dbo.mt_account.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [neraca_ak_5_v]");
    }
};
