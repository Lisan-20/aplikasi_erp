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
        DB::statement("CREATE OR ALTER VIEW dbo.v_penerimaan_brg_ver
AS
SELECT     dbo.tc_penerimaan_barang.kode_penerimaan, dbo.tc_penerimaan_barang.no_po, dbo.tc_penerimaan_barang.tgl_penerimaan, dbo.tc_penerimaan_barang_detail.jumlah_kirim, 
                      dbo.tc_po_det.jumlah_harga_netto AS total_jumlah_semua, dbo.mt_supplier.namasupplier, dbo.tc_po_det.discount, dbo.tc_po_det.harga_satuan, dbo.tc_po_det.jumlah_harga_netto, 
                      dbo.tc_penerimaan_barang_detail.jumlah_kirim * dbo.tc_po_det.harga_satuan_netto AS total_jumlah, dbo.tc_penerimaan_barang.petugas, dbo.tc_penerimaan_barang_detail.kode_brg, 
                      dbo.tc_penerimaan_barang.kodesupplier, dbo.mt_barang.nama_brg, dbo.tc_penerimaan_barang_detail.tgl_ver, dbo.tc_penerimaan_barang_detail.status_ver, 
                      dbo.tc_penerimaan_barang_detail.kode_detail_penerimaan_barang, dbo.mt_barang.harga_satuan AS harga, dbo.mt_barang.flag_medis, dbo.tc_po.kode_bagian, 
                      YEAR(dbo.tc_penerimaan_barang.tgl_penerimaan) AS Expr1, dbo.tc_penerimaan_barang.flag_is
FROM         dbo.mt_supplier INNER JOIN
                      dbo.tc_penerimaan_barang ON dbo.mt_supplier.kodesupplier = dbo.tc_penerimaan_barang.kodesupplier INNER JOIN
                      dbo.tc_po_det INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON dbo.tc_po_det.id_tc_po_det = dbo.tc_penerimaan_barang_detail.id_tc_po_det ON 
                      dbo.tc_penerimaan_barang.kode_penerimaan = dbo.tc_penerimaan_barang_detail.kode_penerimaan INNER JOIN
                      dbo.tc_po ON dbo.tc_po_det.id_tc_po = dbo.tc_po.id_tc_po INNER JOIN
                      dbo.mt_barang ON dbo.tc_po_det.kode_brg = dbo.mt_barang.kode_brg
WHERE     (YEAR(dbo.tc_penerimaan_barang.tgl_penerimaan) >= 2022)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_penerimaan_brg_ver]");
    }
};
