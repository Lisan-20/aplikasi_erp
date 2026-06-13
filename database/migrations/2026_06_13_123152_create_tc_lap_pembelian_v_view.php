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
        DB::statement("CREATE VIEW dbo.tc_lap_pembelian_v
AS
SELECT DISTINCT 
                      dbo.tc_penerimaan_barang.tgl_penerimaan, dbo.tc_penerimaan_barang.kode_penerimaan, dbo.mt_barang.nama_brg, dbo.mt_barang.kode_brg, dbo.tc_po_det.jumlah_besar, 
                      dbo.mt_barang.satuan_besar, dbo.tc_po_det.ppn, dbo.tc_po_det.discount_rp, dbo.tc_po_det.jumlah_harga, dbo.tc_po_det.jumlah_harga_netto, dbo.tc_po.no_po, 
                      dbo.tc_permohonan.kode_permohonan, dbo.mt_supplier.namasupplier, dbo.tc_po.tgl_po, dbo.tc_po.kodesupplier, dbo.mt_barang.[content], dbo.mt_barang.diskon_on, dbo.mt_barang.diskon_off, 
                      dbo.tc_po_det.harga_satuan, dbo.mt_rekap_stok.harga_beli, dbo.tc_po_det.discount, dbo.tc_po.flag_is
FROM         dbo.tc_penerimaan_barang INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON dbo.tc_penerimaan_barang.kode_penerimaan = dbo.tc_penerimaan_barang_detail.kode_penerimaan INNER JOIN
                      dbo.mt_barang ON dbo.tc_penerimaan_barang_detail.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.tc_po ON dbo.tc_penerimaan_barang.no_po = dbo.tc_po.no_po INNER JOIN
                      dbo.tc_po_det ON dbo.tc_penerimaan_barang_detail.id_tc_po_det = dbo.tc_po_det.id_tc_po_det INNER JOIN
                      dbo.tc_permohonan ON dbo.tc_po_det.id_tc_permohonan = dbo.tc_permohonan.id_tc_permohonan INNER JOIN
                      dbo.mt_supplier ON dbo.tc_po.kodesupplier = dbo.mt_supplier.kodesupplier INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mt_barang.kode_brg = dbo.mt_rekap_stok.kode_brg
WHERE     (dbo.mt_rekap_stok.kode_bagian_gudang = '060201')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_lap_pembelian_v]");
    }
};
