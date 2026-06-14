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
        DB::statement("CREATE OR ALTER VIEW dbo.posting_lev_1_v_d
AS
SELECT     dbo.tx_posting_4_a.level_1, dbo.master_hist_bl.acc_no, dbo.master_hist_bl.[level], dbo.tx_posting_4_a.bulan, dbo.tx_posting_4_a.tahun, dbo.tx_posting_4_a.jumlah,
                       dbo.master_hist_bl.mutasi_d
FROM         dbo.master_hist_bl INNER JOIN
                      dbo.tx_posting_4_a ON dbo.master_hist_bl.acc_no = dbo.tx_posting_4_a.level_1 AND dbo.master_hist_bl.bulan = dbo.tx_posting_4_a.bulan AND 
                      dbo.master_hist_bl.tahun = dbo.tx_posting_4_a.tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [posting_lev_1_v_d]");
    }
};
