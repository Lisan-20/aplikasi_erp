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
        DB::statement("CREATE VIEW dbo.v_saldo_awal_cashflow_hist_bl
AS
SELECT     TOP (100) PERCENT dbo.master_hist_bl.tahun, dbo.master_hist_bl.bulan, dbo.master_hist_bl.saldo_akhir AS saldo_awal, dbo.master_hist_bl.acc_no, dbo.Bank_v.acc_nama, dbo.Bank_v.id_bank, 
                      dbo.master_hist_bl.saldo_awal AS saldo_awal_tahun, dbo.Bank_v.Kas_Bank, dbo.Bank_v.urutan
FROM         dbo.master_hist_bl INNER JOIN
                      dbo.Bank_v ON dbo.master_hist_bl.acc_no = dbo.Bank_v.acc_no
ORDER BY dbo.master_hist_bl.bulan, dbo.Bank_v.urutan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_saldo_awal_cashflow_hist_bl]");
    }
};
