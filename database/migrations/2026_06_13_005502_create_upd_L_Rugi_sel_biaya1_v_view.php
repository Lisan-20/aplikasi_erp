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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_L_Rugi_sel_biaya1_v
AS
SELECT     SUM(dbo.L_Rugi_bag_fix_temp.rupiah) AS total_pend, SUM(dbo.L_Rugi_bag_fix_temp.rupiah_ll) AS total_pend_ll, dbo.L_Rugi_bag_fix_temp.bulan, dbo.L_Rugi_bag_fix_temp.tahun, 
                      dbo.L_Rugi_bag_fix_temp.acc_no, dbo.L_Rugi_bag_fix_temp.acc_nama, 
                      CASE dbo.L_Rugi_bag_fix_temp.acc_no WHEN 3110000 THEN '4110000' WHEN 3120000 THEN 4120000 WHEN 3130000 THEN '4130000' WHEN 3150000 THEN 4140000 ELSE 4210000 END AS acc_beban
FROM         dbo.L_Rugi_bag_fix_temp INNER JOIN
                      dbo.mt_account ON dbo.L_Rugi_bag_fix_temp.acc_no = dbo.mt_account.acc_no
WHERE     (dbo.mt_account.kode_utama = '3') AND (dbo.mt_account.level_coa = 3) AND (dbo.mt_account.kode_golongan = 1)
GROUP BY dbo.L_Rugi_bag_fix_temp.bulan, dbo.L_Rugi_bag_fix_temp.tahun, dbo.L_Rugi_bag_fix_temp.acc_no, dbo.L_Rugi_bag_fix_temp.acc_nama
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_L_Rugi_sel_biaya1_v]");
    }
};
