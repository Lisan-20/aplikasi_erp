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
        DB::statement("CREATE VIEW dbo.upd_L_Rugi_all_fix_temp_ok_v
AS
SELECT     dbo.upd_L_Rugi_all_fix_temp_v.rupiah_upd, dbo.L_Rugi_all_fix_temp.rupiah, dbo.upd_L_Rugi_all_fix_temp_v.acc_no, dbo.L_Rugi_all_fix_temp.evektif_sel, dbo.upd_L_Rugi_all_fix_temp_v.tahun, 
                      dbo.upd_L_Rugi_all_fix_temp_v.bulan, dbo.L_Rugi_all_fix_temp.rupiah_ll, dbo.L_Rugi_all_fix_temp.rupiah_sel
FROM         dbo.L_Rugi_all_fix_temp INNER JOIN
                      dbo.upd_L_Rugi_all_fix_temp_v ON dbo.L_Rugi_all_fix_temp.acc_no = dbo.upd_L_Rugi_all_fix_temp_v.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_L_Rugi_all_fix_temp_ok_v]");
    }
};
