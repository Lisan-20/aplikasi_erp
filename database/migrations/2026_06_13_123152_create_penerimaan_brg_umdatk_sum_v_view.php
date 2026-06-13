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
        DB::statement("CREATE VIEW dbo.penerimaan_brg_umdatk_sum_v
AS
SELECT     TOP (100) PERCENT dbo.transaksi_umd_detail.id_trans_umd, dbo.transaksi_umd.no_bukti, dbo.transaksi_umd_detail.id_tc_permohonan_det, 
                      dbo.transaksi_umd.status_bayar, dbo.transaksi_umd_detail.jumlah_besar, dbo.transaksi_umd_detail.kode_brg, dbo.transaksi_umd_detail.harga_satuan, 
                      dbo.transaksi_umd_detail.pilih_satuan, dbo.transaksi_umd_detail.satuan, dbo.transaksi_umd_detail.[content], dbo.transaksi_umd.kode_supplier, 
                      dbo.mt_supplier.namasupplier, dbo.transaksi_umd_detail.id_tc_trans_umd_det, dbo.transaksi_umd.tgl_transaksi, dbo.transaksi_umd_detail.bonus_kecil, 
                      dbo.transaksi_umd_detail.jumlah_harga, dbo.transaksi_umd_detail.discount, dbo.transaksi_umd_detail.bonus_besar, dbo.transaksi_umd_detail.discount_rp, 
                      dbo.transaksi_umd_detail.discount_psn, dbo.transaksi_umd_detail.status_batal, dbo.transaksi_umd_detail.status_close, dbo.mt_barang_nm.nama_brg, 
                      dbo.tc_permohonan_cash_atk.kode_permohonan
FROM         dbo.tc_permohonan_cash_det_atk INNER JOIN
                      dbo.transaksi_umd INNER JOIN
                      dbo.transaksi_umd_detail ON dbo.transaksi_umd.id_trans_umd = dbo.transaksi_umd_detail.id_trans_umd INNER JOIN
                      dbo.mt_supplier ON dbo.transaksi_umd.kode_supplier = dbo.mt_supplier.kodesupplier INNER JOIN
                      dbo.mt_barang_nm ON dbo.transaksi_umd_detail.kode_brg = dbo.mt_barang_nm.kode_brg ON 
                      dbo.tc_permohonan_cash_det_atk.id_tc_permohonan = dbo.transaksi_umd_detail.id_tc_permohonan FULL OUTER JOIN
                      dbo.tc_permohonan_cash_atk ON dbo.tc_permohonan_cash_det_atk.id_tc_permohonan = dbo.tc_permohonan_cash_atk.id_tc_permohonan
GROUP BY dbo.transaksi_umd_detail.id_trans_umd, dbo.transaksi_umd.no_bukti, dbo.transaksi_umd_detail.id_tc_permohonan_det, dbo.transaksi_umd.status_bayar, 
                      dbo.transaksi_umd_detail.jumlah_besar, dbo.transaksi_umd_detail.kode_brg, dbo.transaksi_umd_detail.harga_satuan, dbo.transaksi_umd_detail.pilih_satuan, 
                      dbo.transaksi_umd_detail.satuan, dbo.transaksi_umd_detail.[content], dbo.transaksi_umd.kode_supplier, dbo.mt_supplier.namasupplier, 
                      dbo.transaksi_umd_detail.id_tc_trans_umd_det, dbo.transaksi_umd.tgl_transaksi, dbo.transaksi_umd_detail.bonus_kecil, dbo.transaksi_umd_detail.jumlah_harga, 
                      dbo.transaksi_umd_detail.discount, dbo.transaksi_umd_detail.bonus_besar, dbo.transaksi_umd_detail.discount_rp, dbo.transaksi_umd_detail.discount_psn, 
                      dbo.transaksi_umd_detail.status_batal, dbo.transaksi_umd_detail.status_close, dbo.mt_barang_nm.nama_brg, 
                      dbo.tc_permohonan_cash_atk.kode_permohonan
HAVING      (dbo.transaksi_umd.status_bayar = '1')
ORDER BY dbo.transaksi_umd_detail.id_trans_umd
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_brg_umdatk_sum_v]");
    }
};
