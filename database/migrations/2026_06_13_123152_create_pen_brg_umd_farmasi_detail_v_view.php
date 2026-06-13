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
        DB::statement("CREATE VIEW dbo.pen_brg_umd_farmasi_detail_v
AS
SELECT     dbo.transaksi_umd_detail.id_trans_umd, dbo.transaksi_umd.no_bukti, dbo.transaksi_umd_detail.id_tc_permohonan_det, 
                      dbo.transaksi_umd.status_bayar, dbo.transaksi_umd_detail.jumlah_besar, dbo.transaksi_umd_detail.kode_brg, 
                      dbo.transaksi_umd_detail.harga_satuan, dbo.transaksi_umd_detail.pilih_satuan, dbo.transaksi_umd_detail.satuan, 
                      dbo.transaksi_umd_detail.[content], dbo.transaksi_umd.kode_supplier, dbo.mt_supplier.namasupplier, dbo.transaksi_umd_detail.id_tc_trans_umd_det,
                       dbo.transaksi_umd.tgl_transaksi, dbo.mt_barang.nama_brg, dbo.transaksi_umd_detail.bonus_kecil, dbo.transaksi_umd_detail.jumlah_harga, 
                      dbo.transaksi_umd_detail.discount, dbo.transaksi_umd_detail.bonus_besar, dbo.transaksi_umd_detail.discount_rp, 
                      dbo.transaksi_umd_detail.discount_psn, dbo.transaksi_umd_detail.status_batal, dbo.transaksi_umd_detail.status_close, 
                      dbo.tc_permohonan_cash.kode_permohonan, dbo.tc_penerimaan_barang_detail_temp.kode_brg AS Expr1, 
                      dbo.tc_penerimaan_barang_detail_temp.jumlah_pesan, dbo.tc_penerimaan_barang_detail_temp.jumlah_kirim, 
                      dbo.tc_penerimaan_barang_detail_temp.id_tc_trans_umd_det AS Expr2, dbo.tc_penerimaan_barang_detail_temp.no_batch, 
                      dbo.tc_penerimaan_barang_detail_temp.tgl_kadaluarsa
FROM         dbo.transaksi_umd INNER JOIN
                      dbo.transaksi_umd_detail ON dbo.transaksi_umd.id_trans_umd = dbo.transaksi_umd_detail.id_trans_umd INNER JOIN
                      dbo.tc_permohonan_cash_det ON dbo.transaksi_umd_detail.id_tc_permohonan_det = dbo.tc_permohonan_cash_det.id_tc_permohonan_det INNER JOIN
                      dbo.tc_permohonan_cash ON dbo.tc_permohonan_cash_det.id_tc_permohonan = dbo.tc_permohonan_cash.id_tc_permohonan INNER JOIN
                      dbo.mt_supplier ON dbo.transaksi_umd.kode_supplier = dbo.mt_supplier.kodesupplier INNER JOIN
                      dbo.mt_barang ON dbo.transaksi_umd_detail.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.tc_penerimaan_barang_detail_temp ON dbo.mt_barang.kode_brg = dbo.tc_penerimaan_barang_detail_temp.kode_brg AND 
                      dbo.transaksi_umd_detail.id_tc_trans_umd_det = dbo.tc_penerimaan_barang_detail_temp.id_tc_trans_umd_det
WHERE     (dbo.transaksi_umd.status_bayar = '1')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pen_brg_umd_farmasi_detail_v]");
    }
};
