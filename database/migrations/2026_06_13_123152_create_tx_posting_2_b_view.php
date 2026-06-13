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
        DB::statement("CREATE OR ALTER VIEW dbo.tx_posting_2_b
AS
SELECT     SUM(dbo.tx_posting_b.jumlah) AS jumlah, dbo.mt_account.referensi AS level_3, dbo.tx_posting_b.bulan, dbo.tx_posting_b.tahun, dbo.tx_posting_b.ko_wil
FROM         dbo.mt_account INNER JOIN
                      dbo.tx_posting_b ON dbo.mt_account.acc_no = dbo.tx_posting_b.level_4
GROUP BY dbo.mt_account.referensi, dbo.mt_account.referensi, dbo.tx_posting_b.bulan, dbo.tx_posting_b.tahun, dbo.tx_posting_b.ko_wil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tx_posting_2_b]");
    }
};
