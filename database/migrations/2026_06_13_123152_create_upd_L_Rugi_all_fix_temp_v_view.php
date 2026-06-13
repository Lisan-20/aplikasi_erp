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
        DB::statement("CREATE VIEW dbo.upd_L_Rugi_all_fix_temp_v
AS
SELECT     TOP (100) PERCENT dbo.mt_account.kode_utama, dbo.mt_account.kode_golongan, dbo.mt_account.level_coa, SUM(dbo.L_Rugi_all_temp.debet) AS debet, SUM(dbo.L_Rugi_all_temp.kredit) 
                      AS kredit, dbo.L_Rugi_all_temp.bulan, dbo.L_Rugi_all_temp.tahun, dbo.mt_account.acc_no, dbo.mt_account.acc_nama, dbo.L_Rugi_all_temp.acc_no AS Expr1, dbo.mt_account.acc_type, 
                      CASE WHEN acc_type = 'D' THEN SUM(debet) - SUM(kredit) ELSE SUM(kredit) - SUM(debet) END AS rupiah_upd
FROM         dbo.mt_account INNER JOIN
                      dbo.L_Rugi_all_temp ON dbo.mt_account.acc_no = dbo.L_Rugi_all_temp.acc_no
GROUP BY dbo.L_Rugi_all_temp.bulan, dbo.L_Rugi_all_temp.tahun, dbo.mt_account.acc_no, dbo.mt_account.acc_nama, dbo.mt_account.kode_utama, dbo.mt_account.kode_golongan, 
                      dbo.mt_account.level_coa, dbo.L_Rugi_all_temp.acc_no, dbo.mt_account.acc_type
ORDER BY dbo.L_Rugi_all_temp.tahun, dbo.L_Rugi_all_temp.bulan, dbo.mt_account.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_L_Rugi_all_fix_temp_v]");
    }
};
