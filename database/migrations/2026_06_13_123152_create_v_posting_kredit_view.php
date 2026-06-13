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
        DB::statement("CREATE OR ALTER VIEW dbo.v_posting_kredit
AS
SELECT     TOP (100) PERCENT SUM(tx_nominal) AS kredit, acc_no, tx_tipe, MONTH(tx_tgl) AS bulan, YEAR(tx_tgl) AS tahun, ko_wil
FROM         dbo.tx_harian
GROUP BY acc_no, YEAR(tx_tgl), MONTH(tx_tgl), tx_tipe, ko_wil
HAVING      (tx_tipe = 'K')
ORDER BY bulan, tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_posting_kredit]");
    }
};
