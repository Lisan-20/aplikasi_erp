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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_harga_brg_v
AS
SELECT     dbo.tc_po_det.harga_satuan / dbo.tc_po_det.[content] AS hrg_kecil, dbo.tc_po_det.harga_satuan, dbo.mt_rekap_stok.harga_beli, dbo.mt_rekap_stok.harga_persediaan, 
                      dbo.mt_barang.harga_satuan AS hrg_sekarang, dbo.mt_barang.nama_brg, dbo.mt_barang.kode_brg, dbo.tc_po_det.[content], dbo.tc_penerimaan_barang.flag_hutang, 
                      dbo.tc_penerimaan_barang.status_invoice
FROM         dbo.tc_po_det INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON dbo.tc_po_det.kode_brg = dbo.tc_penerimaan_barang_detail.kode_brg INNER JOIN
                      dbo.tc_penerimaan_barang ON dbo.tc_penerimaan_barang_detail.kode_penerimaan = dbo.tc_penerimaan_barang.kode_penerimaan INNER JOIN
                      dbo.tc_po ON dbo.tc_penerimaan_barang.no_po = dbo.tc_po.no_po AND dbo.tc_po_det.id_tc_po = dbo.tc_po.id_tc_po INNER JOIN
                      dbo.mt_barang ON dbo.tc_po_det.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mt_barang.kode_brg = dbo.mt_rekap_stok.kode_brg
WHERE     (dbo.tc_penerimaan_barang.flag_hutang = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_harga_brg_v]");
    }
};
