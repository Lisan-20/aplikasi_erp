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
        DB::statement("CREATE OR ALTER VIEW dbo.posting_lev_1_v_k
AS
SELECT     dbo.tx_posting_4_b.level_1, dbo.master_hist_bl.acc_no, dbo.master_hist_bl.[level], dbo.tx_posting_4_b.bulan, dbo.tx_posting_4_b.tahun, dbo.tx_posting_4_b.jumlah,
                       dbo.master_hist_bl.mutasi_k
FROM         dbo.master_hist_bl INNER JOIN
                      dbo.tx_posting_4_b ON dbo.master_hist_bl.acc_no = dbo.tx_posting_4_b.level_1 AND dbo.master_hist_bl.tahun = dbo.tx_posting_4_b.tahun AND 
                      dbo.master_hist_bl.bulan = dbo.tx_posting_4_b.bulan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [posting_lev_1_v_k]");
    }
};
