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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_jurnal_all_K
AS
SELECT     TOP (100) PERCENT SUM(tx_nominal) AS KREDIT, YEAR(tx_tgl) AS tahun, tx_tipe, kel_jurnal, MONTH(tx_tgl) AS bln
FROM         dbo.tx_harian
GROUP BY YEAR(tx_tgl), tx_tipe, kel_jurnal, MONTH(tx_tgl)
HAVING      (tx_tipe = 'K') AND (YEAR(tx_tgl) = 2021)
ORDER BY kel_jurnal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jurnal_all_K]");
    }
};
