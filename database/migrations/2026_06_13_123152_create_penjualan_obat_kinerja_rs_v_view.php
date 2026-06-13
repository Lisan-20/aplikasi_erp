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
        DB::statement("CREATE OR ALTER VIEW dbo.penjualan_obat_kinerja_rs_v
AS
SELECT     SUM(tx_nominal) AS tx_nominal, tx_tipe AS tipe_jual, YEAR(tx_tgl) AS thn, MONTH(tx_tgl) AS bln, acc_no
FROM         dbo.tx_harian
GROUP BY tx_tipe, YEAR(tx_tgl), MONTH(tx_tgl), acc_no
HAVING      (acc_no IN ('3150101', '3150102'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penjualan_obat_kinerja_rs_v]");
    }
};
