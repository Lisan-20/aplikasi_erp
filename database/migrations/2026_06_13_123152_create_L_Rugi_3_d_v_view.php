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
        DB::statement("CREATE OR ALTER VIEW dbo.L_Rugi_3_d_v
AS
SELECT     dbo.mt_account.acc_no, SUM(dbo.L_Rugi_4_d_v.debet) AS debet, 0 AS kredit, dbo.L_Rugi_4_d_v.bulan, dbo.L_Rugi_4_d_v.tahun, dbo.mt_account.acc_type, dbo.mt_account.referensi
FROM         dbo.mt_account INNER JOIN
                      dbo.L_Rugi_4_d_v ON dbo.mt_account.acc_no = dbo.L_Rugi_4_d_v.referensi
GROUP BY dbo.mt_account.acc_no, dbo.L_Rugi_4_d_v.bulan, dbo.L_Rugi_4_d_v.tahun, dbo.mt_account.referensi, dbo.mt_account.level_coa, dbo.mt_account.acc_type
HAVING      (dbo.mt_account.level_coa = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [L_Rugi_3_d_v]");
    }
};
