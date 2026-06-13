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
        DB::statement("CREATE VIEW dbo.v_posting_d
AS
SELECT     TOP (100) PERCENT dbo.v_posting_debet.acc_no, dbo.v_posting_debet.debet, dbo.master_hist_bl.mutasi_d, dbo.v_posting_debet.bulan, dbo.v_posting_debet.tahun, 
                      dbo.v_posting_debet.ko_wil
FROM         dbo.v_posting_debet INNER JOIN
                      dbo.tbl_proses_posting ON dbo.v_posting_debet.bulan = dbo.tbl_proses_posting.bulan AND dbo.v_posting_debet.tahun = dbo.tbl_proses_posting.tahun INNER JOIN
                      dbo.master_hist_bl ON dbo.v_posting_debet.acc_no = dbo.master_hist_bl.acc_no AND dbo.v_posting_debet.bulan = dbo.master_hist_bl.bulan AND 
                      dbo.v_posting_debet.tahun = dbo.master_hist_bl.tahun AND dbo.v_posting_debet.ko_wil = dbo.master_hist_bl.ko_wil
WHERE     (dbo.tbl_proses_posting.flag IS NULL)
ORDER BY dbo.v_posting_debet.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_posting_d]");
    }
};
