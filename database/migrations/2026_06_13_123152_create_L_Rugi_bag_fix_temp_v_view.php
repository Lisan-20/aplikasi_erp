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
        DB::statement("CREATE VIEW dbo.L_Rugi_bag_fix_temp_v
AS
SELECT     dbo.L_Rugi_bag_fix_temp.acc_no, dbo.L_Rugi_bag_fix_temp.acc_nama, SUM(ISNULL(dbo.L_Rugi_bag_fix_temp.vol, 0)) AS vol, SUM(ISNULL(dbo.L_Rugi_bag_fix_temp.rupiah, 0)) AS rupiah, 
                      SUM(ISNULL(dbo.L_Rugi_bag_fix_temp.ratio, 0)) AS ratio, SUM(ISNULL(dbo.L_Rugi_bag_fix_temp.vol_ll, 0)) AS vol_ll, SUM(ISNULL(dbo.L_Rugi_bag_fix_temp.rupiah_ll, 0)) AS rupiah_ll, 
                      SUM(ISNULL(dbo.L_Rugi_bag_fix_temp.ratio_ll, 0)) AS ratio_ll, SUM(ISNULL(dbo.L_Rugi_bag_fix_temp.vol_sel, 0)) AS vol_sel, SUM(ISNULL(dbo.L_Rugi_bag_fix_temp.rupiah_sel, 0)) AS rupiah_sel, 
                      SUM(ISNULL(dbo.L_Rugi_bag_fix_temp.ratio_sel, 0)) AS ratio_sel, SUM(ISNULL(dbo.L_Rugi_bag_fix_temp.evektif_sel, 0)) AS evektif_sel, dbo.L_Rugi_bag_fix_temp.bulan, 
                      dbo.L_Rugi_bag_fix_temp.tahun, dbo.L_Rugi_bag_fix_temp.tx_tipe, dbo.L_Rugi_bag_fix_temp.referensi, dbo.mt_bagian.grup_rl, 
                      CASE WHEN grup_rl = 1 THEN '030001' ELSE mt_bagian.kode_bagian END AS kode_bagian
FROM         dbo.mt_bagian INNER JOIN
                      dbo.L_Rugi_bag_fix_temp ON dbo.mt_bagian.kode_bagian = dbo.L_Rugi_bag_fix_temp.kode_bagian
GROUP BY dbo.L_Rugi_bag_fix_temp.acc_no, dbo.L_Rugi_bag_fix_temp.acc_nama, dbo.L_Rugi_bag_fix_temp.bulan, dbo.L_Rugi_bag_fix_temp.tahun, dbo.L_Rugi_bag_fix_temp.tx_tipe, 
                      dbo.L_Rugi_bag_fix_temp.referensi, dbo.mt_bagian.grup_rl, CASE WHEN grup_rl = 1 THEN '030001' ELSE mt_bagian.kode_bagian END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [L_Rugi_bag_fix_temp_v]");
    }
};
