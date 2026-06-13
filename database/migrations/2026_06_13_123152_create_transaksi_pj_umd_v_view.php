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
        DB::statement("CREATE VIEW dbo.transaksi_pj_umd_v
AS
SELECT     dbo.mt_account.acc_no_rs, dbo.mt_account.acc_no, dbo.transaksi_pj_umd.id_trans_pj_umd, dbo.transaksi_pj_umd.tx_tipe, dbo.transaksi_pj_umd.jumlah_transaksi, 
                      dbo.transaksi_pj_umd.jumlah_umd, dbo.transaksi_pj_umd.selisih, dbo.transaksi_pj_umd.no_bukti, dbo.transaksi_pj_umd.tgl_transaksi, dbo.transaksi_pj_umd.keterangan, 
                      dbo.transaksi_pj_umd.inp_tgl, dbo.transaksi_pj_umd.inp_id, dbo.transaksi_pj_umd.kode_bagian, dbo.transaksi_pj_umd.kode_supplier, dbo.transaksi_pj_umd.kode_perusahaan, 
                      dbo.transaksi_pj_umd.referensi, dbo.transaksi_pj_umd.kode_dr, dbo.transaksi_pj_umd.tgl_ver, dbo.transaksi_pj_umd.tgl_tempo, dbo.transaksi_pj_umd.jumlah_ppn, 
                      dbo.transaksi_pj_umd.jumlah_pph, dbo.transaksi_pj_umd.total, dbo.transaksi_pj_umd.tgl_bayar, dbo.mt_account.id_master_account, dbo.mt_account.acc_nama, dbo.mt_account.kode_akun_detail, 
                      dbo.mt_account.acc_type, dbo.transaksi_pj_umd.acc_no_1, dbo.transaksi_pj_umd.acc_no_2, mt_account_1.acc_nama AS acc_nama2
FROM         dbo.transaksi_pj_umd INNER JOIN
                      dbo.mt_account ON dbo.transaksi_pj_umd.acc_no_1 = dbo.mt_account.acc_no COLLATE Latin1_General_CI_AS LEFT OUTER JOIN
                      dbo.mt_account AS mt_account_1 ON dbo.transaksi_pj_umd.acc_no_2 = mt_account_1.acc_no COLLATE Latin1_General_CI_AS
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [transaksi_pj_umd_v]");
    }
};
