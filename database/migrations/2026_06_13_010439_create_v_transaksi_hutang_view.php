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
        DB::statement("CREATE OR ALTER VIEW dbo.v_transaksi_hutang
AS
SELECT     dbo.transaksi_hutang_detail.jumlah, dbo.transaksi_hutang.acc_no_1, dbo.mt_account.id_master_account, dbo.mt_account.acc_no_rs, dbo.mt_account.acc_nama, 
                      dbo.transaksi_hutang.id_trans_hutang, dbo.transaksi_hutang.tx_tipe, dbo.transaksi_hutang.jumlah_transaksi, dbo.transaksi_hutang.no_bukti, 
                      dbo.transaksi_hutang.tgl_transaksi, dbo.transaksi_hutang.flag_jurnal, dbo.transaksi_hutang.tgl_ver, dbo.transaksi_hutang.flag_ver, 
                      dbo.transaksi_hutang_detail.acc_no, dbo.transaksi_hutang_detail.id_trans_hutang_detail, dbo.transaksi_hutang.tgl_tempo, dbo.transaksi_hutang_detail.kode_bagian, 
                      dbo.transaksi_hutang_detail.kode_perusahaan, dbo.transaksi_hutang_detail.kode_supplier, dbo.transaksi_hutang_detail.kode_dr, 
                      dbo.transaksi_hutang_detail.tipe_tx, dbo.transaksi_hutang_detail.input_id, dbo.transaksi_hutang_detail.keterangan, dbo.transaksi_hutang.flag_tmp, 
                      dbo.transaksi_hutang_detail.status_id, dbo.dd_user.username
FROM         dbo.transaksi_hutang INNER JOIN
                      dbo.transaksi_hutang_detail ON dbo.transaksi_hutang.id_trans_hutang = dbo.transaksi_hutang_detail.id_trans_hutang INNER JOIN
                      dbo.mt_account ON dbo.transaksi_hutang_detail.acc_no = dbo.mt_account.acc_no LEFT OUTER JOIN
                      dbo.dd_user ON dbo.transaksi_hutang_detail.status_id = dbo.dd_user.id_dd_user
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_transaksi_hutang]");
    }
};
