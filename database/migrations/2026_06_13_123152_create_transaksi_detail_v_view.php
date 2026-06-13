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
        DB::statement("CREATE VIEW dbo.transaksi_detail_v
AS
SELECT     TOP (100) PERCENT dbo.mt_account.acc_no_rs, dbo.mt_account.acc_nama, dbo.transaksi_detail.acc_no, dbo.transaksi_detail.jumlah, dbo.transaksi_detail.input_id AS no_induk, 
                      dbo.transaksi_detail.input_tgl, dbo.transaksi_detail.status_tgl, dbo.transaksi_detail.id_transaksi_detail, dbo.transaksi.flag_modul, dbo.transaksi.no_bukti, dbo.transaksi.no_bp, 
                      dbo.transaksi.tgl_transaksi, dbo.transaksi.flag_tmp, dbo.transaksi.flag_jurnal, dbo.transaksi.id_transaksi, dbo.mt_account.kode_akun_detail, dbo.transaksi.jumlah_transaksi, 
                      dbo.transaksi_detail.tipe_tx, dbo.mt_account.acc_type, dbo.transaksi_detail.keterangan, dbo.transaksi.kd_wil, dbo.transaksi.tgl_eod, dbo.transaksi.id_transaksi_ref, 
                      dbo.mt_account.id_master_account, dbo.transaksi.flag_ver, dbo.transaksi.tgl_ver, dbo.transaksi_detail.kode_bagian, dbo.transaksi_detail.kode_supplier, dbo.transaksi_detail.kode_perusahaan, 
                      dbo.transaksi_detail.kode_dr, dbo.transaksi_detail.status, dbo.mt_supplier.namasupplier, dbo.transaksi_detail.input_id
FROM         dbo.transaksi_detail INNER JOIN
                      dbo.transaksi ON dbo.transaksi_detail.id_transaksi = dbo.transaksi.id_transaksi LEFT OUTER JOIN
                      dbo.mt_supplier ON dbo.transaksi_detail.kode_supplier = dbo.mt_supplier.kodesupplier LEFT OUTER JOIN
                      dbo.mt_account ON dbo.transaksi_detail.acc_no = dbo.mt_account.acc_no
ORDER BY dbo.transaksi.no_bukti
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [transaksi_detail_v]");
    }
};
