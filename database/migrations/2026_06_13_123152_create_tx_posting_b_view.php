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
        DB::statement("CREATE OR ALTER VIEW dbo.tx_posting_b
AS
SELECT     dbo.mt_account.referensi AS level_4, SUM(dbo.tx_harian_post.tx_nominal) AS jumlah, dbo.tx_harian_post.bulan, dbo.tx_harian_post.tahun, 
                      dbo.tx_harian_post.ko_wil
FROM         dbo.mt_account INNER JOIN
                      dbo.tx_harian_post ON dbo.mt_account.acc_no = dbo.tx_harian_post.acc_no
WHERE     (dbo.tx_harian_post.tx_tipe = 'K')
GROUP BY dbo.mt_account.referensi, dbo.tx_harian_post.bulan, dbo.tx_harian_post.tahun, dbo.tx_harian_post.ko_wil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tx_posting_b]");
    }
};
