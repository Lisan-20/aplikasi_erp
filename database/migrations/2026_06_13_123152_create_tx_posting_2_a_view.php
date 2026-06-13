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
        DB::statement("CREATE OR ALTER VIEW dbo.tx_posting_2_a
AS
SELECT     TOP (100) PERCENT dbo.mt_account.referensi AS level_3, SUM(dbo.tx_posting_a.jumlah) AS jumlah, dbo.tx_posting_a.bulan, dbo.tx_posting_a.tahun, 
                      dbo.tx_posting_a.ko_wil
FROM         dbo.mt_account INNER JOIN
                      dbo.tx_posting_a ON dbo.mt_account.acc_no = dbo.tx_posting_a.level_4
GROUP BY dbo.mt_account.referensi, dbo.tx_posting_a.bulan, dbo.tx_posting_a.tahun, dbo.tx_posting_a.ko_wil
ORDER BY level_3
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tx_posting_2_a]");
    }
};
