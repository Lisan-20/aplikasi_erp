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
        DB::statement("CREATE VIEW dbo.upd_L_Rugi_bag_fix_v
AS
SELECT     CASE WHEN acc_type = 'D' THEN SUM(debet) - SUM(kredit) ELSE SUM(kredit) - SUM(debet) END AS rupiah_upd, dbo.L_Rugi_bag_union_v.kode_bagian, dbo.mt_account.acc_no, 
                      dbo.mt_account.acc_nama, SUM(dbo.L_Rugi_bag_union_v.debet) AS debet, SUM(dbo.L_Rugi_bag_union_v.kredit) AS kredit, dbo.L_Rugi_bag_union_v.bulan, dbo.L_Rugi_bag_union_v.tahun, 
                      dbo.L_Rugi_bag_union_v.referensi, dbo.mt_account.acc_type
FROM         dbo.mt_account INNER JOIN
                      dbo.L_Rugi_bag_union_v ON dbo.mt_account.acc_no = dbo.L_Rugi_bag_union_v.acc_no
GROUP BY dbo.L_Rugi_bag_union_v.kode_bagian, dbo.mt_account.acc_no, dbo.mt_account.acc_nama, dbo.L_Rugi_bag_union_v.bulan, dbo.L_Rugi_bag_union_v.tahun, dbo.L_Rugi_bag_union_v.referensi, 
                      dbo.mt_account.acc_type
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_L_Rugi_bag_fix_v]");
    }
};
