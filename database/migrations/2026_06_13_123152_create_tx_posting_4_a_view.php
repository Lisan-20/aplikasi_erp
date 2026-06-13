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
        DB::statement("CREATE OR ALTER VIEW dbo.tx_posting_4_a
AS
SELECT     dbo.mt_account.referensi AS level_1, SUM(dbo.tx_posting_3_a.jumlah) AS jumlah, dbo.tx_posting_3_a.bulan, dbo.tx_posting_3_a.tahun, 
                      dbo.tx_posting_3_a.ko_wil
FROM         dbo.mt_account INNER JOIN
                      dbo.tx_posting_3_a ON dbo.mt_account.acc_no = dbo.tx_posting_3_a.level_2
GROUP BY dbo.mt_account.referensi, dbo.tx_posting_3_a.bulan, dbo.tx_posting_3_a.tahun, dbo.tx_posting_3_a.ko_wil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tx_posting_4_a]");
    }
};
