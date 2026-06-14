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
        DB::statement("CREATE OR ALTER VIEW dbo.kasbank_k_union_all_v
AS
SELECT     dbo.kasbank_union_all_v.acc_no, dbo.kasbank_union_all_v.tx_tipe, SUM(DISTINCT dbo.kasbank_union_all_v.jumlah) AS saldo_awal, DAY(dbo.kasbank_union_all_v.tgl_transaksi) AS tgl, 
                      MONTH(dbo.kasbank_union_all_v.tgl_transaksi) AS bln, YEAR(dbo.kasbank_union_all_v.tgl_transaksi) AS thn, dbo.Bank_v.Kas_Bank, dbo.Bank_v.acc_nama, dbo.Bank_v.id_bank, 
                      dbo.kasbank_union_all_v.kode_bagian, dbo.kasbank_union_all_v.tgl_transaksi, dbo.kasbank_union_all_v.id_bd_tc_trans
FROM         dbo.kasbank_union_all_v INNER JOIN
                      dbo.Bank_v ON dbo.kasbank_union_all_v.acc_no = dbo.Bank_v.acc_no
GROUP BY dbo.kasbank_union_all_v.acc_no, dbo.kasbank_union_all_v.tx_tipe, DAY(dbo.kasbank_union_all_v.tgl_transaksi), YEAR(dbo.kasbank_union_all_v.tgl_transaksi), 
                      MONTH(dbo.kasbank_union_all_v.tgl_transaksi), dbo.Bank_v.Kas_Bank, dbo.Bank_v.acc_nama, dbo.Bank_v.id_bank, dbo.kasbank_union_all_v.kode_bagian, 
                      dbo.kasbank_union_all_v.tgl_transaksi, dbo.kasbank_union_all_v.id_bd_tc_trans
HAVING      (dbo.kasbank_union_all_v.tx_tipe = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kasbank_k_union_all_v]");
    }
};
