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
        DB::statement("CREATE OR ALTER VIEW dbo.update_pendapatan_alkes_tx_harian_RI_v
AS
SELECT     acc_no, YEAR(tx_tgl) AS Expr1, MONTH(tx_tgl) AS Expr2, kode_barang, no_urut
FROM         dbo.tx_harian
WHERE     (YEAR(tx_tgl) >= 2022) AND (kode_barang LIKE 'E%') AND (acc_no = 3150101)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_pendapatan_alkes_tx_harian_RI_v]");
    }
};
