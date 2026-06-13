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

CREATE VIEW dbo.tc_lap_pembelian_nm_v
AS
SELECT     dbo.tc_penerimaan_barang_nm.tgl_penerimaan, dbo.tc_penerimaan_barang_nm.kode_penerimaan, dbo.mt_barang_nm.nama_brg, 
                      dbo.mt_barang_nm.kode_brg, dbo.tc_po_nm_det.jumlah_besar, dbo.mt_barang_nm.satuan_besar, dbo.mt_rekap_stok_nm.harga_beli, 
                      dbo.tc_po_nm_det.ppn, dbo.tc_po_nm_det.discount_rp, dbo.tc_po_nm_det.jumlah_harga, dbo.tc_po_nm_det.jumlah_harga_netto, dbo.tc_po_nm.no_po,
                       dbo.tc_permohonan_nm.kode_permohonan, dbo.mt_supplier.namasupplier, dbo.tc_po_nm.tgl_po
FROM         dbo.tc_penerimaan_barang_nm INNER JOIN
                      dbo.tc_penerimaan_barang_nm_detail ON 
                      dbo.tc_penerimaan_barang_nm.kode_penerimaan = dbo.tc_penerimaan_barang_nm_detail.kode_penerimaan INNER JOIN
                      dbo.tc_po_nm ON dbo.tc_penerimaan_barang_nm.no_po = dbo.tc_po_nm.no_po INNER JOIN
                      dbo.tc_po_nm_det ON dbo.tc_penerimaan_barang_nm_detail.id_tc_po_det = dbo.tc_po_nm_det.id_tc_po_det INNER JOIN
                      dbo.mt_supplier ON dbo.tc_po_nm.kodesupplier = dbo.mt_supplier.kodesupplier INNER JOIN
                      dbo.mt_barang_nm ON dbo.tc_penerimaan_barang_nm_detail.kode_brg = dbo.mt_barang_nm.kode_brg INNER JOIN
                      dbo.mt_rekap_stok_nm ON dbo.mt_barang_nm.kode_brg = dbo.mt_rekap_stok_nm.kode_brg INNER JOIN
                      dbo.tc_permohonan_nm ON dbo.tc_po_nm_det.id_tc_permohonan = dbo.tc_permohonan_nm.id_tc_permohonan


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_lap_pembelian_nm_v]");
    }
};
