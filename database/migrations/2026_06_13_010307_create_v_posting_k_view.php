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
        DB::statement("CREATE OR ALTER VIEW dbo.v_posting_k
AS
SELECT     TOP (100) PERCENT dbo.v_posting_kredit.acc_no, dbo.v_posting_kredit.kredit, dbo.master_hist_bl.mutasi_k, dbo.v_posting_kredit.bulan, dbo.v_posting_kredit.tahun, 
                      dbo.v_posting_kredit.ko_wil
FROM         dbo.tbl_proses_posting INNER JOIN
                      dbo.v_posting_kredit ON dbo.tbl_proses_posting.bulan = dbo.v_posting_kredit.bulan AND dbo.tbl_proses_posting.tahun = dbo.v_posting_kredit.tahun INNER JOIN
                      dbo.master_hist_bl ON dbo.v_posting_kredit.acc_no = dbo.master_hist_bl.acc_no AND dbo.v_posting_kredit.bulan = dbo.master_hist_bl.bulan AND 
                      dbo.v_posting_kredit.tahun = dbo.master_hist_bl.tahun AND dbo.v_posting_kredit.ko_wil = dbo.master_hist_bl.ko_wil
WHERE     (dbo.tbl_proses_posting.flag IS NULL)
ORDER BY dbo.v_posting_kredit.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_posting_k]");
    }
};
