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
        DB::statement("CREATE OR ALTER VIEW dbo.tx_posting_3_b
AS
SELECT     SUM(dbo.tx_posting_2_b.jumlah) AS jumlah, dbo.mt_account.referensi AS level_2, dbo.tx_posting_2_b.bulan, dbo.tx_posting_2_b.tahun, 
                      dbo.tx_posting_2_b.ko_wil
FROM         dbo.tx_posting_2_b INNER JOIN
                      dbo.mt_account ON dbo.tx_posting_2_b.level_3 = dbo.mt_account.acc_no
GROUP BY dbo.mt_account.referensi, dbo.tx_posting_2_b.bulan, dbo.tx_posting_2_b.tahun, dbo.tx_posting_2_b.ko_wil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tx_posting_3_b]");
    }
};
