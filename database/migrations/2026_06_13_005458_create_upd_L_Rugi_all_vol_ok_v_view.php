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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_L_Rugi_all_vol_ok_v
AS
SELECT     dbo.L_Rugi_bag_fix_temp.vol, dbo.upd_L_Rugi_all_vol_v.vol AS vol_up, dbo.L_Rugi_bag_fix_temp.vol_ll, dbo.L_Rugi_bag_fix_temp.kode_bagian, dbo.upd_L_Rugi_all_vol_v.kode_bagian_tujuan, 
                      dbo.upd_L_Rugi_all_vol_v.bln AS bulan, dbo.upd_L_Rugi_all_vol_v.thn AS tahun, dbo.L_Rugi_bag_fix_temp.vol_sel
FROM         dbo.upd_L_Rugi_all_vol_v INNER JOIN
                      dbo.L_Rugi_bag_fix_temp ON dbo.upd_L_Rugi_all_vol_v.bln = dbo.L_Rugi_bag_fix_temp.bulan AND dbo.upd_L_Rugi_all_vol_v.kode_bagian_tujuan = dbo.L_Rugi_bag_fix_temp.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_L_Rugi_all_vol_ok_v]");
    }
};
