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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_L_Rugi_bag_ok_fix_v
AS
SELECT     TOP (100) PERCENT dbo.L_Rugi_bag_fix_temp.acc_no, dbo.upd_L_Rugi_bag_fix_v.bulan, dbo.upd_L_Rugi_bag_fix_v.tahun, dbo.L_Rugi_bag_fix_temp.rupiah, 
                      dbo.upd_L_Rugi_bag_fix_v.rupiah_upd, dbo.L_Rugi_bag_fix_temp.rupiah_ll, dbo.L_Rugi_bag_fix_temp.kode_bagian, dbo.L_Rugi_bag_fix_temp.rupiah_sel
FROM         dbo.upd_L_Rugi_bag_fix_v INNER JOIN
                      dbo.L_Rugi_bag_fix_temp ON dbo.upd_L_Rugi_bag_fix_v.acc_no = dbo.L_Rugi_bag_fix_temp.acc_no AND dbo.upd_L_Rugi_bag_fix_v.kode_bagian = dbo.L_Rugi_bag_fix_temp.kode_bagian AND 
                      dbo.upd_L_Rugi_bag_fix_v.bulan = dbo.L_Rugi_bag_fix_temp.bulan
ORDER BY dbo.L_Rugi_bag_fix_temp.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_L_Rugi_bag_ok_fix_v]");
    }
};
