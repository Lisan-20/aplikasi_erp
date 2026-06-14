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
        DB::statement("CREATE OR ALTER VIEW dbo.update_alkes_tx_harian_rj_v
AS
SELECT     acc_no, YEAR(tx_tgl) AS Expr1, MONTH(tx_tgl) AS Expr2, kode_barang, no_urut
FROM         dbo.tx_harian
WHERE     (YEAR(tx_tgl) >= 2022) AND (kode_barang LIKE 'E%') AND (acc_no = 4120104)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_alkes_tx_harian_rj_v]");
    }
};
