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
        DB::statement("CREATE VIEW dbo.history_harga_beli_det
AS
SELECT     dbo.tc_penerimaan_barang.tgl_penerimaan, dbo.tc_penerimaan_barang_detail.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_supplier.namasupplier, 
                      dbo.mt_barang.satuan_kecil, dbo.tc_penerimaan_barang.kodesupplier, dbo.tc_penerimaan_barang_detail.harga_satuan, 
                      dbo.tc_penerimaan_barang_detail.kode_penerimaan
FROM         dbo.mt_supplier INNER JOIN
                      dbo.tc_po_det INNER JOIN
                      dbo.tc_po ON dbo.tc_po_det.id_tc_po = dbo.tc_po.id_tc_po ON dbo.mt_supplier.kodesupplier = dbo.tc_po.kodesupplier INNER JOIN
                      dbo.mt_barang INNER JOIN
                      dbo.tc_penerimaan_barang INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON dbo.tc_penerimaan_barang.kode_penerimaan = dbo.tc_penerimaan_barang_detail.kode_penerimaan ON 
                      dbo.mt_barang.kode_brg = dbo.tc_penerimaan_barang_detail.kode_brg ON dbo.tc_po_det.kode_brg = dbo.tc_penerimaan_barang_detail.kode_brg AND 
                      dbo.tc_po.kodesupplier = dbo.tc_penerimaan_barang.kodesupplier
GROUP BY dbo.tc_penerimaan_barang.tgl_penerimaan, dbo.tc_penerimaan_barang_detail.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_supplier.namasupplier, 
                      dbo.mt_barang.satuan_kecil, dbo.tc_penerimaan_barang.kodesupplier, dbo.tc_penerimaan_barang_detail.harga_satuan, 
                      dbo.tc_penerimaan_barang_detail.kode_penerimaan
HAVING      (dbo.tc_penerimaan_barang_detail.harga_satuan > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [history_harga_beli_det]");
    }
};
