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
        DB::statement("CREATE OR ALTER VIEW dbo.posting_lev_4_v_k
AS
SELECT     dbo.master_hist_bl.acc_no, dbo.tx_posting_b.level_4, dbo.master_hist_bl.[level], dbo.tx_posting_b.jumlah, dbo.master_hist_bl.mutasi_k, dbo.tx_posting_b.bulan, 
                      dbo.tx_posting_b.tahun
FROM         dbo.master_hist_bl INNER JOIN
                      dbo.tx_posting_b ON dbo.master_hist_bl.acc_no = dbo.tx_posting_b.level_4 AND dbo.master_hist_bl.bulan = dbo.tx_posting_b.bulan AND 
                      dbo.master_hist_bl.tahun = dbo.tx_posting_b.tahun AND dbo.master_hist_bl.ko_wil = dbo.tx_posting_b.ko_wil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [posting_lev_4_v_k]");
    }
};
