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
        DB::statement("CREATE OR ALTER VIEW dbo.penerimaan_barang_umdumum_v
AS
SELECT     SUM(CASE WHEN tc_penerimaan_barang_nm_detail.jumlah_kirim IS NULL THEN 0 ELSE tc_penerimaan_barang_nm_detail.jumlah_kirim END) AS jumlah_sdh_terima, 
                      dbo.tc_umd_umum_detail_v.id_trans_umd, dbo.tc_umd_umum_detail_v.no_bukti, dbo.tc_umd_umum_detail_v.jumlah_besar, dbo.tc_umd_umum_detail_v.kode_brg, 
                      dbo.tc_umd_umum_detail_v.harga_satuan, dbo.tc_umd_umum_detail_v.satuan, dbo.tc_umd_umum_detail_v.[content], dbo.tc_umd_umum_detail_v.kode_supplier, 
                      dbo.tc_umd_umum_detail_v.namasupplier, dbo.tc_umd_umum_detail_v.id_tc_trans_umd_det, dbo.tc_umd_umum_detail_v.tgl_transaksi, dbo.tc_umd_umum_detail_v.nama_brg, 
                      dbo.tc_umd_umum_detail_v.bonus_kecil, dbo.tc_umd_umum_detail_v.jumlah_harga, dbo.tc_umd_umum_detail_v.discount, dbo.tc_umd_umum_detail_v.bonus_besar, 
                      dbo.tc_umd_umum_detail_v.discount_rp, dbo.tc_umd_umum_detail_v.discount_psn, dbo.tc_umd_umum_detail_v.status_batal, dbo.tc_umd_umum_detail_v.status_close, 
                      dbo.tc_umd_umum_detail_v.kode_permohonan, dbo.tc_penerimaan_barang_nm_detail.jumlah_kirim
FROM         dbo.tc_umd_umum_detail_v LEFT OUTER JOIN
                      dbo.tc_penerimaan_barang_nm_detail ON dbo.tc_umd_umum_detail_v.id_tc_trans_umd_det = dbo.tc_penerimaan_barang_nm_detail.id_tc_trans_umd_det
GROUP BY dbo.tc_umd_umum_detail_v.id_trans_umd, dbo.tc_umd_umum_detail_v.no_bukti, dbo.tc_umd_umum_detail_v.jumlah_besar, dbo.tc_umd_umum_detail_v.kode_brg, 
                      dbo.tc_umd_umum_detail_v.harga_satuan, dbo.tc_umd_umum_detail_v.satuan, dbo.tc_umd_umum_detail_v.[content], dbo.tc_umd_umum_detail_v.kode_supplier, 
                      dbo.tc_umd_umum_detail_v.namasupplier, dbo.tc_umd_umum_detail_v.id_tc_trans_umd_det, dbo.tc_umd_umum_detail_v.tgl_transaksi, dbo.tc_umd_umum_detail_v.nama_brg, 
                      dbo.tc_umd_umum_detail_v.bonus_kecil, dbo.tc_umd_umum_detail_v.jumlah_harga, dbo.tc_umd_umum_detail_v.discount, dbo.tc_umd_umum_detail_v.bonus_besar, 
                      dbo.tc_umd_umum_detail_v.discount_rp, dbo.tc_umd_umum_detail_v.discount_psn, dbo.tc_umd_umum_detail_v.status_batal, dbo.tc_umd_umum_detail_v.status_close, 
                      dbo.tc_umd_umum_detail_v.kode_permohonan, dbo.tc_penerimaan_barang_nm_detail.jumlah_kirim
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_barang_umdumum_v]");
    }
};
