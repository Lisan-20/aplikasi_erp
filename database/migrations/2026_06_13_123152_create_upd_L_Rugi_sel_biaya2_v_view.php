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
        DB::statement("CREATE VIEW dbo.upd_L_Rugi_sel_biaya2_v
AS
SELECT     TOP (100) PERCENT dbo.L_Rugi_all_fix_temp.ratio, dbo.L_Rugi_all_fix_temp.ratio_ll, dbo.L_Rugi_all_fix_temp.ratio_sel, dbo.upd_L_Rugi_sel_biaya4_v.total_pend, 
                      dbo.upd_L_Rugi_sel_biaya4_v.total_pend_ll, dbo.L_Rugi_all_fix_temp.acc_no, dbo.L_Rugi_all_fix_temp.acc_nama, dbo.L_Rugi_all_fix_temp.rupiah, dbo.L_Rugi_all_fix_temp.rupiah_ll, 
                      ISNULL(dbo.L_Rugi_all_fix_temp.rupiah, 0) / ISNULL(dbo.upd_L_Rugi_sel_biaya4_v.total_pend, 0) * 100 AS ratio_up, ISNULL(dbo.L_Rugi_all_fix_temp.rupiah_ll, 0) 
                      / ISNULL(dbo.upd_L_Rugi_sel_biaya4_v.total_pend_ll, 0) * 100 AS ratio_ll_up, dbo.L_Rugi_all_fix_temp.bulan, dbo.L_Rugi_all_fix_temp.tahun
FROM         dbo.L_Rugi_all_fix_temp INNER JOIN
                      dbo.mt_account ON dbo.L_Rugi_all_fix_temp.acc_no = dbo.mt_account.acc_no INNER JOIN
                      dbo.mt_account AS mt_account_1 ON dbo.mt_account.referensi = mt_account_1.acc_no INNER JOIN
                      dbo.upd_L_Rugi_sel_biaya4_v ON dbo.L_Rugi_all_fix_temp.bulan = dbo.upd_L_Rugi_sel_biaya4_v.bulan AND dbo.L_Rugi_all_fix_temp.tahun = dbo.upd_L_Rugi_sel_biaya4_v.tahun
ORDER BY dbo.L_Rugi_all_fix_temp.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_L_Rugi_sel_biaya2_v]");
    }
};
