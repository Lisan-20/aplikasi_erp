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
        DB::statement("CREATE VIEW dbo.L_Rugi_bag_4_k_v
AS
SELECT     dbo.mt_account.acc_no, SUM(dbo.L_Rugi_bag_5_k_v.kredit) AS kredit, dbo.L_Rugi_bag_5_k_v.bulan, dbo.L_Rugi_bag_5_k_v.tahun, dbo.mt_account.referensi, dbo.mt_account.level_coa, 
                      dbo.L_Rugi_bag_5_k_v.kode_bagian
FROM         dbo.mt_account INNER JOIN
                      dbo.L_Rugi_bag_5_k_v ON dbo.mt_account.acc_no = dbo.L_Rugi_bag_5_k_v.referensi
GROUP BY dbo.mt_account.acc_no, dbo.L_Rugi_bag_5_k_v.bulan, dbo.L_Rugi_bag_5_k_v.tahun, dbo.mt_account.referensi, dbo.mt_account.level_coa, dbo.L_Rugi_bag_5_k_v.kode_bagian
HAVING      (dbo.mt_account.level_coa = 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [L_Rugi_bag_4_k_v]");
    }
};
