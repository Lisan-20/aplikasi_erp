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
        DB::statement("CREATE VIEW dbo.saldo_awal_off_d_fixed_v
AS
SELECT     dbo.bd_tc_trans_detail.acc_no, dbo.bd_tc_trans_detail.tx_tipe, SUM(dbo.bd_tc_trans_detail.jumlah) AS saldo_awal, DAY(dbo.bd_tc_trans_detail.tgl_transaksi) AS tgl, 
                      MONTH(dbo.bd_tc_trans_detail.tgl_transaksi) AS bln, YEAR(dbo.bd_tc_trans_detail.tgl_transaksi) AS thn, dbo.Bank_v.id_bank, dbo.Bank_v.Kas_Bank, dbo.Bank_v.acc_nama, 
                      dbo.bd_tc_trans_detail.kode_bagian, dbo.bd_tc_trans_detail.tgl_transaksi, dbo.bd_tc_trans_detail.id_bd_tc_trans
FROM         dbo.bd_tc_trans_detail INNER JOIN
                      dbo.Bank_v ON dbo.bd_tc_trans_detail.acc_no = dbo.Bank_v.acc_no
GROUP BY dbo.bd_tc_trans_detail.acc_no, dbo.bd_tc_trans_detail.tx_tipe, DAY(dbo.bd_tc_trans_detail.tgl_transaksi), YEAR(dbo.bd_tc_trans_detail.tgl_transaksi), 
                      MONTH(dbo.bd_tc_trans_detail.tgl_transaksi), dbo.Bank_v.id_bank, dbo.Bank_v.Kas_Bank, dbo.Bank_v.acc_nama, dbo.bd_tc_trans_detail.kode_bagian, dbo.bd_tc_trans_detail.tgl_transaksi, 
                      dbo.bd_tc_trans_detail.id_bd_tc_trans
HAVING      (dbo.bd_tc_trans_detail.tx_tipe = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [saldo_awal_off_d_fixed_v]");
    }
};
