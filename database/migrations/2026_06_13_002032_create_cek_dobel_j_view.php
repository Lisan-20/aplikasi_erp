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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_dobel_j
AS
SELECT     TOP (100) PERCENT COUNT(no_bukti) AS Expr1, no_bukti, YEAR(tx_tgl) AS Expr2, MONTH(tx_tgl) AS Expr3, tx_nominal, tx_tipe, tx_uraian, acc_no, kel_jurnal, no_registrasi, jumlah_barang, 
                      kode_barang, kode_bagian, kode_tc_trans_kasir
FROM         dbo.tx_harian
GROUP BY YEAR(tx_tgl), MONTH(tx_tgl), tx_nominal, tx_tipe, no_bukti, tx_uraian, acc_no, kel_jurnal, no_registrasi, jumlah_barang, kode_barang, kode_bagian, kode_tc_trans_kasir
HAVING      (COUNT(no_bukti) > 1) AND (YEAR(tx_tgl) = 2021) AND (tx_tipe = 'D')
ORDER BY tx_nominal DESC, kel_jurnal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_dobel_j]");
    }
};
