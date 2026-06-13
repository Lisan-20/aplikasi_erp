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
        DB::statement("CREATE VIEW dbo.cek_jurnal_rj_k
AS
SELECT     SUM(tx_nominal) AS K, kel_jurnal, YEAR(tx_tgl) AS thn, MONTH(tx_tgl) AS bln, tx_tipe, no_registrasi
FROM         dbo.tx_harian
GROUP BY kel_jurnal, YEAR(tx_tgl), MONTH(tx_tgl), tx_tipe, no_registrasi
HAVING      (tx_tipe = 'K') AND (kel_jurnal = '1') AND (YEAR(tx_tgl) = 2018) AND (MONTH(tx_tgl) = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jurnal_rj_k]");
    }
};
