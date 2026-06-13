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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_pembayaran_supplier_v
AS
SELECT     TOP (100) PERCENT MONTH(dbo.tx_harian.tx_tgl) AS bln, YEAR(dbo.tx_harian.tx_tgl) AS thn, SUM(dbo.tx_harian.tx_nominal) AS Expr1, dbo.Bank_v.acc_nama
FROM         dbo.tx_harian INNER JOIN
                      dbo.Bank_v ON dbo.tx_harian.acc_no = dbo.Bank_v.acc_no INNER JOIN
                      dbo.mt_supplier ON dbo.tx_harian.kode_supplier = dbo.mt_supplier.kodesupplier
GROUP BY MONTH(dbo.tx_harian.tx_tgl), YEAR(dbo.tx_harian.tx_tgl), dbo.Bank_v.acc_nama
HAVING      (MONTH(dbo.tx_harian.tx_tgl) >= 10)
ORDER BY bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_pembayaran_supplier_v]");
    }
};
