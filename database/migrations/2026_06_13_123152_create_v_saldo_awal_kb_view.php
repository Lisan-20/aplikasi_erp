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
        DB::statement("CREATE OR ALTER VIEW dbo.v_saldo_awal_kb
AS
SELECT     TOP (100) PERCENT dbo.Bank_v.id_bank, dbo.Bank_v.Kas_Bank, dbo.Bank_v.acc_nama, dbo.Bank_v.acc_no, dbo.Bank_v.urutan, 
                      dbo.master_hist_bl.tahun, dbo.master_hist_bl.bulan, SUM(dbo.master_hist_bl.saldo_awal) AS saldo_awal
FROM         dbo.Bank_v INNER JOIN
                      dbo.master_hist_bl ON dbo.Bank_v.acc_no = dbo.master_hist_bl.acc_no
GROUP BY dbo.Bank_v.id_bank, dbo.Bank_v.Kas_Bank, dbo.Bank_v.acc_nama, dbo.Bank_v.acc_no, dbo.Bank_v.urutan, dbo.master_hist_bl.tahun, 
                      dbo.master_hist_bl.bulan
ORDER BY dbo.Bank_v.urutan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_saldo_awal_kb]");
    }
};
