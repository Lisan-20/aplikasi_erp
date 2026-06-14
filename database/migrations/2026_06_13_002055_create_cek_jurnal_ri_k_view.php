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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_jurnal_ri_k
AS
SELECT     SUM(tx_nominal) AS K, kel_jurnal, YEAR(tx_tgl) AS thn, MONTH(tx_tgl) AS bln, no_registrasi
FROM         dbo.tx_harian
GROUP BY kel_jurnal, YEAR(tx_tgl), MONTH(tx_tgl), tx_tipe, no_registrasi
HAVING      (tx_tipe = 'K') AND (kel_jurnal = '2') AND (YEAR(tx_tgl) = 2018)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jurnal_ri_k]");
    }
};
