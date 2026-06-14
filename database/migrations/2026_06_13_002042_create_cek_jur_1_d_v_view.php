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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_jur_1_d_v
AS
SELECT     SUM(tx_nominal) AS sum_debet, tx_tipe, kel_jurnal, MONTH(tx_tgl) AS bln, YEAR(tx_tgl) AS thn, no_bukti, no_registrasi, kode_tc_trans_kasir
FROM         dbo.tx_harian
GROUP BY tx_tipe, kel_jurnal, MONTH(tx_tgl), YEAR(tx_tgl), no_bukti, no_registrasi, kode_tc_trans_kasir
HAVING      (tx_tipe = 'D') AND (YEAR(tx_tgl) = 2021) AND (kel_jurnal = '1') AND (MONTH(tx_tgl) = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jur_1_d_v]");
    }
};
