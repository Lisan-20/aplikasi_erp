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
        DB::statement("CREATE OR ALTER VIEW dbo.penerimaan_barang_nm_v
AS
SELECT     dbo.tc_penerimaan_barang_nm.kode_penerimaan, dbo.tc_penerimaan_barang_nm.no_po, dbo.tc_penerimaan_barang_nm.tgl_penerimaan, 
                      dbo.tc_penerimaan_barang_nm_detail.jumlah_kirim, dbo.tc_po_nm_det.jumlah_harga_netto AS total_jumlah_semua, dbo.mt_supplier.namasupplier, 
                      dbo.tc_po_nm_det.discount, dbo.tc_po_nm_det.harga_satuan, dbo.tc_po_nm_det.jumlah_harga_netto, 
                      dbo.tc_penerimaan_barang_nm_detail.jumlah_kirim * dbo.tc_po_nm_det.harga_satuan_netto AS total_jumlah, dbo.tc_penerimaan_barang_nm.petugas, 
                      dbo.tc_penerimaan_barang_nm_detail.kode_brg, dbo.tc_penerimaan_barang_nm.kodesupplier, dbo.mt_barang_jasa.nama_brg, 
                      dbo.tc_penerimaan_barang_nm_detail.tgl_ver, dbo.tc_penerimaan_barang_nm_detail.status_ver, 
                      dbo.tc_penerimaan_barang_nm_detail.kode_detail_penerimaan_barang, dbo.mt_barang_jasa.kode_golongan
FROM         dbo.mt_barang_jasa RIGHT OUTER JOIN
                      dbo.mt_supplier INNER JOIN
                      dbo.tc_penerimaan_barang_nm ON dbo.mt_supplier.kodesupplier = dbo.tc_penerimaan_barang_nm.kodesupplier INNER JOIN
                      dbo.tc_po_nm_det INNER JOIN
                      dbo.tc_penerimaan_barang_nm_detail ON dbo.tc_po_nm_det.id_tc_po_det = dbo.tc_penerimaan_barang_nm_detail.id_tc_po_det ON 
                      dbo.tc_penerimaan_barang_nm.kode_penerimaan = dbo.tc_penerimaan_barang_nm_detail.kode_penerimaan ON 
                      dbo.mt_barang_jasa.kode_brg = dbo.tc_po_nm_det.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_barang_nm_v]");
    }
};
