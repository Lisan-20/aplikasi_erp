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
        DB::statement("CREATE VIEW dbo.L_Rugi_4_K_Unit_v
AS
SELECT     dbo.mt_account.acc_no, SUM(dbo.L_Rugi_5_K_Unit_v.kredit) AS kredit, dbo.L_Rugi_5_K_Unit_v.bulan, dbo.L_Rugi_5_K_Unit_v.tahun, 
                      dbo.mt_account.referensi, dbo.mt_account.level_coa, dbo.L_Rugi_5_K_Unit_v.ko_wil, dbo.L_Rugi_5_K_Unit_v.kode_bagian, 
                      dbo.L_Rugi_5_K_Unit_v.kd_bag_unit
FROM         dbo.mt_account INNER JOIN
                      dbo.L_Rugi_5_K_Unit_v ON dbo.mt_account.acc_no = dbo.L_Rugi_5_K_Unit_v.referensi
GROUP BY dbo.mt_account.acc_no, dbo.L_Rugi_5_K_Unit_v.bulan, dbo.L_Rugi_5_K_Unit_v.tahun, dbo.mt_account.referensi, dbo.mt_account.level_coa, 
                      dbo.L_Rugi_5_K_Unit_v.ko_wil, dbo.L_Rugi_5_K_Unit_v.kode_bagian, dbo.L_Rugi_5_K_Unit_v.kd_bag_unit
HAVING      (dbo.mt_account.level_coa = 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [L_Rugi_4_K_Unit_v]");
    }
};
