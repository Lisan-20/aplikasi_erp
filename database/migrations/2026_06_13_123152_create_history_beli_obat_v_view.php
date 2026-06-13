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
        DB::statement("CREATE VIEW dbo.history_beli_obat_v
AS
SELECT     TOP (100) PERCENT dbo.tc_penerimaan_barang_detail.kode_brg, dbo.tc_penerimaan_barang_detail.harga_satuan AS harga_beli, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, 
                      YEAR(dbo.tc_penerimaan_barang.tgl_penerimaan) AS Expr1, dbo.tc_penerimaan_barang_detail.kode_penerimaan, dbo.mt_barang.flag_medis, dbo.tc_po.kode_bagian
FROM         dbo.tc_penerimaan_barang INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON dbo.tc_penerimaan_barang.kode_penerimaan = dbo.tc_penerimaan_barang_detail.kode_penerimaan INNER JOIN
                      dbo.mt_barang ON dbo.tc_penerimaan_barang_detail.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.tc_po_det ON dbo.tc_penerimaan_barang_detail.id_tc_po_det = dbo.tc_po_det.id_tc_po_det INNER JOIN
                      dbo.tc_po ON dbo.tc_po_det.id_tc_po = dbo.tc_po.id_tc_po
GROUP BY dbo.tc_penerimaan_barang_detail.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.tc_penerimaan_barang_detail.harga_satuan, 
                      YEAR(dbo.tc_penerimaan_barang.tgl_penerimaan), dbo.tc_penerimaan_barang_detail.kode_penerimaan, dbo.mt_barang.flag_medis, dbo.tc_po.kode_bagian
HAVING      (dbo.tc_penerimaan_barang_detail.harga_satuan > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [history_beli_obat_v]");
    }
};
