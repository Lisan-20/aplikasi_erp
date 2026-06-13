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
        DB::statement("CREATE VIEW dbo.tran_hutang_v
AS
SELECT     dbo.transaksi_hutang.id_trans_hutang, dbo.transaksi_hutang.acc_no_1, dbo.transaksi_hutang.acc_no_2, dbo.transaksi_hutang.tx_tipe, 
                      dbo.transaksi_hutang.jumlah_transaksi, dbo.transaksi_hutang.no_bukti, dbo.transaksi_hutang.tgl_transaksi, dbo.transaksi_hutang.flag_jurnal, 
                      dbo.transaksi_hutang.keterangan, dbo.transaksi_hutang.inp_tgl, dbo.transaksi_hutang.inp_id, dbo.transaksi_hutang.kode_bagian, 
                      dbo.transaksi_hutang.kode_supplier, dbo.transaksi_hutang.kode_perusahaan, dbo.transaksi_hutang.kode_dr, dbo.transaksi_hutang.stat, 
                      dbo.transaksi_hutang.stat_id, dbo.transaksi_hutang.tgl_bayar, dbo.transaksi_hutang.status_bayar, dbo.transaksi_hutang.flag_ver, 
                      dbo.transaksi_hutang.tgl_ver, dbo.transaksi_hutang.flag_tmp, dbo.transaksi_hutang.flag_modul, dbo.transaksi_hutang.tgl_tempo, 
                      dbo.transaksi_hutang.jumlah_ppn, dbo.transaksi_hutang.jumlah_pph, dbo.transaksi_hutang.total, dbo.mt_account.acc_nama, 
                      dbo.transaksi_hutang.id_bd_tc_trans, mt_account_1.acc_nama AS acc_nama2
FROM         dbo.transaksi_hutang INNER JOIN
                      dbo.mt_account ON dbo.transaksi_hutang.acc_no_1 = dbo.mt_account.acc_no COLLATE Latin1_General_CI_AS INNER JOIN
                      dbo.mt_account AS mt_account_1 ON dbo.transaksi_hutang.acc_no_2 = mt_account_1.acc_no COLLATE Latin1_General_CI_AS
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tran_hutang_v]");
    }
};
