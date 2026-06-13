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
        DB::statement("CREATE VIEW dbo.tx_posting_a
AS
SELECT     TOP (100) PERCENT dbo.mt_account.referensi AS level_4, SUM(dbo.tx_harian_post.tx_nominal) AS jumlah, dbo.tx_harian_post.bulan, dbo.tx_harian_post.tahun, 
                      dbo.tx_harian_post.ko_wil
FROM         dbo.mt_account INNER JOIN
                      dbo.tx_harian_post ON dbo.mt_account.acc_no = dbo.tx_harian_post.acc_no
GROUP BY dbo.mt_account.referensi, dbo.tx_harian_post.tx_tipe, dbo.tx_harian_post.bulan, dbo.tx_harian_post.tahun, dbo.tx_harian_post.ko_wil
HAVING      (dbo.tx_harian_post.tx_tipe = 'D')
ORDER BY level_4
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tx_posting_a]");
    }
};
