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
        DB::statement("CREATE VIEW dbo.tc_umd_farmasi_detail_v
AS
SELECT     TOP (100) PERCENT dbo.transaksi_umd_detail.id_trans_umd, dbo.transaksi_umd.no_bukti, dbo.transaksi_umd_detail.id_tc_permohonan_det, dbo.transaksi_umd.status_bayar, 
                      dbo.transaksi_umd_detail.jumlah_besar, dbo.transaksi_umd_detail.kode_brg, dbo.transaksi_umd_detail.harga_satuan, dbo.transaksi_umd_detail.pilih_satuan, dbo.transaksi_umd_detail.satuan, 
                      dbo.transaksi_umd_detail.[content], dbo.transaksi_umd.kode_supplier, dbo.mt_supplier.namasupplier, dbo.transaksi_umd_detail.id_tc_trans_umd_det, dbo.transaksi_umd.tgl_transaksi, 
                      dbo.mt_barang.nama_brg, dbo.transaksi_umd_detail.bonus_kecil, dbo.transaksi_umd_detail.jumlah_harga, dbo.transaksi_umd_detail.discount, dbo.transaksi_umd_detail.bonus_besar, 
                      dbo.transaksi_umd_detail.discount_rp, dbo.transaksi_umd_detail.discount_psn, dbo.transaksi_umd_detail.status_batal, dbo.transaksi_umd_detail.status_close, 
                      dbo.tc_permohonan_cash.kode_permohonan, dbo.transaksi_umd.kode_bagian, dbo.transaksi_umd.flag_is
FROM         dbo.mt_supplier INNER JOIN
                      dbo.transaksi_umd INNER JOIN
                      dbo.transaksi_umd_detail ON dbo.transaksi_umd.id_trans_umd = dbo.transaksi_umd_detail.id_trans_umd ON dbo.mt_supplier.kodesupplier = dbo.transaksi_umd.kode_supplier INNER JOIN
                      dbo.mt_barang ON dbo.transaksi_umd_detail.kode_brg = dbo.mt_barang.kode_brg LEFT OUTER JOIN
                      dbo.tc_permohonan_cash INNER JOIN
                      dbo.tc_permohonan_cash_det ON dbo.tc_permohonan_cash.id_tc_permohonan = dbo.tc_permohonan_cash_det.id_tc_permohonan ON 
                      dbo.transaksi_umd_detail.id_tc_permohonan_det = dbo.tc_permohonan_cash_det.id_tc_permohonan_det
WHERE     (dbo.transaksi_umd.status_bayar = '1')
ORDER BY dbo.transaksi_umd_detail.id_trans_umd DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_umd_farmasi_detail_v]");
    }
};
