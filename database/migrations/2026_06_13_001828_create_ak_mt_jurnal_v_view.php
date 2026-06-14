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
        DB::statement("
CREATE OR ALTER VIEW dbo.ak_mt_jurnal_v
AS
SELECT     dbo.mt_jurnal.id_mt_jurnal, dbo.mt_jurnal.acc_no, dbo.mt_jurnal.tx_nominal, dbo.mt_jurnal.tx_uraian, dbo.mt_jurnal.tx_tgl, dbo.mt_jurnal.tx_tipe, 
                      dbo.mt_jurnal.no_jurnal, dbo.mt_jurnal.no_det_jurnal, dbo.mt_jurnal.no_bukti, dbo.mt_jurnal.kode_bagian, dbo.mt_jurnal.kd_tipe_bayar, 
                      dbo.mt_jurnal.no_induk, dbo.mt_jurnal.posting, dbo.mt_jurnal.kode_tbl_trans, dbo.mt_jurnal.jenis_tbl_trans, dbo.mt_jurnal.tgl_input, 
                      dbo.mt_jurnal.kode_proses, dbo.mt_jurnal.kode_jenis_proses, dbo.mt_jurnal.kode_komponen, dbo.mt_jurnal.no_kuitansi, dbo.mt_jurnal.no_kunjungan,
                       dbo.mt_jurnal.tx_no_mr, dbo.mt_account.id_mt_account, dbo.mt_account.acc_nama, dbo.mt_account.acc_type, dbo.mt_jurnal.id_ak_tc_transaksi_det, 
                      dbo.mt_account.acc_no_rs
FROM         dbo.mt_jurnal LEFT OUTER JOIN
                      dbo.mt_account ON dbo.mt_jurnal.acc_no = dbo.mt_account.acc_no

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ak_mt_jurnal_v]");
    }
};
