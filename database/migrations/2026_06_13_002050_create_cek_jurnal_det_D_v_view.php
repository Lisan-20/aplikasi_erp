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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_jurnal_det_D_v
AS
SELECT     TOP (100) PERCENT SUM(tx_nominal) AS Debet, tx_tipe, DAY(tx_tgl) AS tgl, MONTH(tx_tgl) AS bln, YEAR(tx_tgl) AS thn, no_registrasi, kel_jurnal
FROM         dbo.tx_harian
WHERE     (MONTH(tx_tgl) = 2)
GROUP BY tx_tipe, no_bukti, DAY(tx_tgl), MONTH(tx_tgl), YEAR(tx_tgl), no_registrasi, kel_jurnal
HAVING      (tx_tipe = 'D') AND (kel_jurnal = '2')
ORDER BY no_bukti
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jurnal_det_D_v]");
    }
};
