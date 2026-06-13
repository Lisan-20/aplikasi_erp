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
        DB::statement("CREATE VIEW dbo.posting_lev_2_v_d
AS
SELECT     dbo.master_hist_bl.acc_no, dbo.tx_posting_3_a.level_2, dbo.master_hist_bl.[level], dbo.master_hist_bl.bulan, dbo.master_hist_bl.tahun, dbo.tx_posting_3_a.jumlah, 
                      dbo.master_hist_bl.mutasi_d
FROM         dbo.master_hist_bl INNER JOIN
                      dbo.tx_posting_3_a ON dbo.master_hist_bl.acc_no = dbo.tx_posting_3_a.level_2 AND dbo.master_hist_bl.bulan = dbo.tx_posting_3_a.bulan AND 
                      dbo.master_hist_bl.tahun = dbo.tx_posting_3_a.tahun AND dbo.master_hist_bl.ko_wil = dbo.tx_posting_3_a.ko_wil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [posting_lev_2_v_d]");
    }
};
