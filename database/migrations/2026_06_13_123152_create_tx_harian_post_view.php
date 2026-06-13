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
        DB::statement("CREATE VIEW dbo.tx_harian_post
AS
SELECT     TOP (100) PERCENT dbo.tx_harian.acc_no, SUM(dbo.tx_harian.tx_nominal) AS tx_nominal, dbo.tx_harian.tx_tipe, dbo.tbl_proses_posting.bulan, 
                      dbo.tbl_proses_posting.tahun, dbo.tx_harian.ko_wil
FROM         dbo.tx_harian INNER JOIN
                      dbo.tbl_proses_posting ON MONTH(dbo.tx_harian.tx_tgl) = dbo.tbl_proses_posting.bulan AND YEAR(dbo.tx_harian.tx_tgl) = dbo.tbl_proses_posting.tahun
WHERE     (dbo.tx_harian.flag_posting IS NULL) AND (dbo.tbl_proses_posting.flag IS NULL)
GROUP BY dbo.tx_harian.acc_no, dbo.tx_harian.tx_tipe, dbo.tbl_proses_posting.bulan, dbo.tbl_proses_posting.tahun, dbo.tx_harian.ko_wil
ORDER BY dbo.tx_harian.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tx_harian_post]");
    }
};
