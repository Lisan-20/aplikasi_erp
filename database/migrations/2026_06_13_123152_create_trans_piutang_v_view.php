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
        DB::statement("CREATE VIEW dbo.trans_piutang_v
AS
SELECT     dbo.transaksi_piutang.id_trans_piutang, dbo.transaksi_piutang.acc_no_1, dbo.transaksi_piutang.acc_no_2, dbo.transaksi_piutang.tx_tipe, 
                      dbo.transaksi_piutang.jumlah_transaksi, dbo.transaksi_piutang.no_bukti, dbo.transaksi_piutang.tgl_transaksi, dbo.transaksi_piutang.flag_jurnal, 
                      dbo.transaksi_piutang.keterangan, dbo.transaksi_piutang.inp_tgl, dbo.transaksi_piutang.inp_id, dbo.transaksi_piutang.kode_bagian, 
                      dbo.transaksi_piutang.kode_supplier, dbo.transaksi_piutang.kode_perusahaan, dbo.transaksi_piutang.kode_dr, dbo.transaksi_piutang.stat, 
                      dbo.transaksi_piutang.stat_id, dbo.transaksi_piutang.tgl_bayar, dbo.transaksi_piutang.status_bayar, dbo.transaksi_piutang.flag_ver, dbo.transaksi_piutang.tgl_ver, 
                      dbo.transaksi_piutang.flag_tmp, dbo.transaksi_piutang.flag_modul, dbo.transaksi_piutang.tgl_tempo, dbo.transaksi_piutang.jumlah_ppn, 
                      dbo.transaksi_piutang.jumlah_pph, dbo.transaksi_piutang.total, dbo.mt_account.acc_nama, dbo.transaksi_piutang.id_bd_tc_trans
FROM         dbo.transaksi_piutang INNER JOIN
                      dbo.mt_account ON dbo.transaksi_piutang.acc_no_1 = dbo.mt_account.acc_no COLLATE Latin1_General_CI_AS
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [trans_piutang_v]");
    }
};
