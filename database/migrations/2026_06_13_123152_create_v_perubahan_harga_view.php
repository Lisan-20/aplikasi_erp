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
        DB::statement("CREATE VIEW dbo.v_perubahan_harga
AS
SELECT     dbo.mt_barang.nama_brg, dbo.mt_rekap_stok.harga_beli AS hrg_skrg, dbo.tc_po_det.harga_satuan AS hrg_po, MAX(dbo.tc_po_det.id_tc_po_det) AS id_po, dbo.mt_barang.kode_brg, 
                      dbo.mt_barang.satuan_kecil, MAX(dbo.tc_po.no_po) AS no_po, MAX(dbo.tc_penerimaan_barang.kode_penerimaan) AS no_lpb, dbo.mt_barang.satuan_besar, dbo.mt_barang.[content], 
                      dbo.mt_barang.flag_medis, dbo.tc_po.kode_bagian
FROM         dbo.tc_po_det INNER JOIN
                      dbo.mt_barang ON dbo.tc_po_det.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON dbo.mt_barang.kode_brg = dbo.tc_penerimaan_barang_detail.kode_brg AND 
                      dbo.tc_po_det.id_tc_po_det = dbo.tc_penerimaan_barang_detail.id_tc_po_det INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mt_barang.kode_brg = dbo.mt_rekap_stok.kode_brg INNER JOIN
                      dbo.tc_po ON dbo.tc_po_det.id_tc_po = dbo.tc_po.id_tc_po INNER JOIN
                      dbo.tc_penerimaan_barang ON dbo.tc_penerimaan_barang_detail.kode_penerimaan = dbo.tc_penerimaan_barang.kode_penerimaan
GROUP BY dbo.mt_barang.nama_brg, dbo.mt_rekap_stok.harga_beli, dbo.tc_po_det.harga_satuan, dbo.mt_barang.kode_brg, dbo.mt_barang.satuan_kecil, dbo.mt_barang.satuan_besar, 
                      dbo.mt_barang.[content], dbo.mt_barang.flag_medis, dbo.tc_po.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_perubahan_harga]");
    }
};
