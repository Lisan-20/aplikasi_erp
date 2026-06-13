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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_tukar_faktur_nm_det_v
AS
SELECT     dbo.tc_penerimaan_barang_nm.kode_penerimaan, dbo.tc_penerimaan_barang_nm.no_po, dbo.tc_penerimaan_barang_nm.tgl_penerimaan, 
                      dbo.tc_penerimaan_barang_nm_detail.jumlah_kirim, dbo.tc_po_nm_det.jumlah_harga_netto, dbo.mt_supplier.namasupplier, dbo.tc_po_nm_det.discount, 
                      dbo.tc_po_nm_det.harga_satuan, dbo.tc_po_nm_det.harga_satuan_netto, 
                      dbo.tc_penerimaan_barang_nm_detail.jumlah_kirim * dbo.tc_po_nm_det.harga_satuan_netto AS total_jumlah, dbo.tc_penerimaan_barang_nm_detail.kode_brg, 
                      dbo.mt_barang_nm.nama_brg, dbo.mt_barang_nm.satuan_besar, dbo.tc_po_nm_det.ppn
FROM         dbo.mt_supplier INNER JOIN
                      dbo.tc_penerimaan_barang_nm ON dbo.mt_supplier.kodesupplier = dbo.tc_penerimaan_barang_nm.kodesupplier INNER JOIN
                      dbo.tc_penerimaan_barang_nm_detail ON dbo.tc_penerimaan_barang_nm.kode_penerimaan = dbo.tc_penerimaan_barang_nm_detail.kode_penerimaan INNER JOIN
                      dbo.tc_po_nm_det ON dbo.tc_penerimaan_barang_nm_detail.id_tc_po_det = dbo.tc_po_nm_det.id_tc_po_det LEFT OUTER JOIN
                      dbo.mt_barang_nm ON dbo.tc_penerimaan_barang_nm_detail.kode_brg = dbo.mt_barang_nm.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_tukar_faktur_nm_det_v]");
    }
};
