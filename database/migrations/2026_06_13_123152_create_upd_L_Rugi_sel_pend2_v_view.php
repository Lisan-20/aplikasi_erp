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
        DB::statement("CREATE VIEW dbo.upd_L_Rugi_sel_pend2_v
AS
SELECT     dbo.upd_L_Rugi_sel_pend1_v.total_pend, dbo.L_Rugi_bag_fix_temp.rupiah, dbo.upd_L_Rugi_sel_pend1_v.total_pend_ll, dbo.L_Rugi_bag_fix_temp.rupiah_ll, dbo.L_Rugi_bag_fix_temp.ratio, 
                      dbo.L_Rugi_bag_fix_temp.ratio_ll, dbo.L_Rugi_bag_fix_temp.rupiah / dbo.upd_L_Rugi_sel_pend1_v.total_pend * 100 AS ratio_up, 
                      dbo.L_Rugi_bag_fix_temp.rupiah_ll / dbo.upd_L_Rugi_sel_pend1_v.total_pend_ll * 100 AS ratio_ll_up, dbo.L_Rugi_bag_fix_temp.ratio_sel, dbo.upd_L_Rugi_sel_pend1_v.bulan, 
                      dbo.upd_L_Rugi_sel_pend1_v.tahun
FROM         dbo.upd_L_Rugi_sel_pend1_v INNER JOIN
                      dbo.L_Rugi_bag_fix_temp ON dbo.upd_L_Rugi_sel_pend1_v.bulan = dbo.L_Rugi_bag_fix_temp.bulan AND dbo.upd_L_Rugi_sel_pend1_v.tahun = dbo.L_Rugi_bag_fix_temp.tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_L_Rugi_sel_pend2_v]");
    }
};
