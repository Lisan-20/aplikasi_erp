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
        DB::statement("CREATE VIEW dbo.transaksi_umd_v
AS
SELECT     TOP (100) PERCENT dbo.mt_account.acc_no_rs, dbo.mt_account.acc_nama, dbo.mt_account.kode_akun_detail, dbo.mt_account.acc_type, 
                      dbo.mt_account.id_master_account, dbo.transaksi_umd.jumlah_transaksi, dbo.transaksi_umd.no_bukti, dbo.transaksi_umd.tgl_transaksi, 
                      dbo.transaksi_umd.keterangan, dbo.transaksi_umd.kode_bagian, dbo.transaksi_umd.kode_supplier, dbo.transaksi_umd.kode_perusahaan, 
                      dbo.transaksi_umd.referensi, dbo.transaksi_umd.kode_dr, dbo.transaksi_umd.tgl_tempo, dbo.transaksi_umd.tgl_ver, dbo.transaksi_umd.jumlah_pph, 
                      dbo.transaksi_umd.jumlah_ppn, dbo.transaksi_umd.total, dbo.transaksi_umd.tgl_bayar, dbo.mt_account.acc_no, dbo.transaksi_umd.inp_id, 
                      dbo.transaksi_umd.inp_tgl, dbo.transaksi_umd.id_trans_umd, dbo.transaksi_umd.tx_tipe
FROM         dbo.transaksi_umd INNER JOIN
                      dbo.mt_account ON dbo.transaksi_umd.acc_no_1 COLLATE SQL_Latin1_General_CP1_CI_AS = dbo.mt_account.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [transaksi_umd_v]");
    }
};
