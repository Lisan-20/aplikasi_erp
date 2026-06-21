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
        DB::statement("CREATE OR ALTER VIEW dbo.posting_lev_4_v_d
AS
SELECT     dbo.master_hist_bl.acc_no, dbo.tx_posting_a.level_4, dbo.master_hist_bl.[level], dbo.tx_posting_a.jumlah, dbo.master_hist_bl.mutasi_d, dbo.tx_posting_a.bulan, 
                      dbo.tx_posting_a.tahun
FROM         dbo.master_hist_bl INNER JOIN
                      dbo.tx_posting_a ON dbo.master_hist_bl.acc_no = dbo.tx_posting_a.level_4 AND dbo.master_hist_bl.tahun = dbo.tx_posting_a.tahun AND 
                      dbo.master_hist_bl.bulan = dbo.tx_posting_a.bulan AND dbo.master_hist_bl.ko_wil = dbo.tx_posting_a.ko_wil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [posting_lev_4_v_d]");
    }
};
