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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pembelian_2_v
AS
SELECT DISTINCT 
                      dbo.mt_barang.nama_brg, dbo.mt_barang.kode_brg, dbo.mt_barang.satuan_besar, dbo.tc_po_det.ppn, dbo.tc_po_det.discount_rp, dbo.tc_po_det.jumlah_harga, dbo.tc_po_det.jumlah_harga_netto, 
                      dbo.tc_po.no_po, dbo.tc_permohonan.kode_permohonan, dbo.mt_supplier.namasupplier, dbo.tc_po.tgl_po, dbo.tc_po.kodesupplier, dbo.mt_barang.[content], dbo.mt_barang.diskon_on, 
                      dbo.mt_barang.diskon_off, dbo.tc_po_det.harga_satuan, dbo.mt_rekap_stok.harga_beli, dbo.tc_po_det.discount, dbo.tc_po_det.jumlah_besar_acc AS jumlah_besar, dbo.tc_po.id_tc_po, 
                      dbo.tc_po.flag_is
FROM         dbo.tc_po INNER JOIN
                      dbo.mt_supplier ON dbo.tc_po.kodesupplier = dbo.mt_supplier.kodesupplier INNER JOIN
                      dbo.tc_permohonan INNER JOIN
                      dbo.tc_po_det ON dbo.tc_permohonan.id_tc_permohonan = dbo.tc_po_det.id_tc_permohonan INNER JOIN
                      dbo.mt_rekap_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_rekap_stok.kode_brg = dbo.mt_barang.kode_brg ON dbo.tc_po_det.kode_brg = dbo.mt_barang.kode_brg ON dbo.tc_po.id_tc_po = dbo.tc_po_det.id_tc_po
WHERE     (dbo.tc_po_det.jumlah_besar_acc > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pembelian_2_v]");
    }
};
