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
        DB::statement("CREATE OR ALTER VIEW dbo.saldo_awal_d
AS
SELECT     TOP (100) PERCENT dbo.master_hist_bl.acc_no, dbo.master_hist_bl.saldo_awal + dbo.master_hist_bl.mutasi_d - dbo.master_hist_bl.mutasi_k AS saldo, 
                      dbo.master_hist_bl.saldo_awal, dbo.master_hist_bl.mutasi_d, dbo.master_hist_bl.mutasi_k, dbo.master_hist_bl.bulan, dbo.master_hist_bl.tahun, 
                      dbo.master_hist_bl.ko_wil
FROM         dbo.master_hist_bl INNER JOIN
                      dbo.tbl_proses_posting ON dbo.master_hist_bl.bulan = dbo.tbl_proses_posting.bulan AND dbo.master_hist_bl.tahun = dbo.tbl_proses_posting.tahun
WHERE     (dbo.master_hist_bl.acc_type = 'D') AND (dbo.tbl_proses_posting.flag IS NULL)
ORDER BY dbo.master_hist_bl.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [saldo_awal_d]");
    }
};
