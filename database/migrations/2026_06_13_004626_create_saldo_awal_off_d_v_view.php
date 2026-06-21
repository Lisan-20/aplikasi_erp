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
        DB::statement("CREATE OR ALTER VIEW dbo.saldo_awal_off_d_v
AS
SELECT     dbo.bd_tc_trans.acc_no, dbo.bd_tc_trans.tx_tipe, SUM(CASE WHEN jumlah IS NULL THEN 0 ELSE jumlah END) AS saldo_awal, DAY(dbo.bd_tc_trans.tgl_transaksi) 
                      AS tgl, MONTH(dbo.bd_tc_trans.tgl_transaksi) AS bln, YEAR(dbo.bd_tc_trans.tgl_transaksi) AS thn, dbo.Bank_v.Kas_Bank, dbo.Bank_v.acc_nama, 
                      dbo.Bank_v.id_bank, dbo.bd_tc_trans.kode_bagian, dbo.bd_tc_trans.tgl_transaksi
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.Bank_v ON dbo.bd_tc_trans.acc_no = dbo.Bank_v.acc_no
GROUP BY dbo.bd_tc_trans.acc_no, dbo.bd_tc_trans.tx_tipe, DAY(dbo.bd_tc_trans.tgl_transaksi), YEAR(dbo.bd_tc_trans.tgl_transaksi), MONTH(dbo.bd_tc_trans.tgl_transaksi), 
                      dbo.Bank_v.Kas_Bank, dbo.Bank_v.acc_nama, dbo.Bank_v.id_bank, dbo.bd_tc_trans.kode_bagian, dbo.bd_tc_trans.tgl_transaksi
HAVING      (dbo.bd_tc_trans.tx_tipe = '0')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [saldo_awal_off_d_v]");
    }
};
