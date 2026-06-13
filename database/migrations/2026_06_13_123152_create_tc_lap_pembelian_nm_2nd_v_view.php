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
        DB::statement("CREATE VIEW dbo.tc_lap_pembelian_nm_2nd_v
AS
SELECT     dbo.mt_barang_nm.nama_brg, dbo.mt_barang_nm.kode_brg, dbo.mt_barang_nm.satuan_besar, dbo.tc_permohonan_nm.kode_permohonan, dbo.mt_barang_nm.type, 
                      dbo.mt_barang_nm.merk, dbo.mt_barang_nm.buatan, dbo.tc_penerimaan_barang_nm_detail.jumlah_pesan, dbo.tc_penerimaan_barang_nm_detail.jumlah_kirim, 
                      dbo.tc_po_nm.tgl_po, dbo.tc_penerimaan_barang_nm.tgl_penerimaan, dbo.tc_po_nm_det.jumlah_besar, dbo.tc_po_nm_det.jumlah_harga_netto, 
                      dbo.tc_penerimaan_barang_nm_detail.jumlah_kirim * dbo.tc_po_nm_det.harga_satuan_netto AS harga, dbo.tc_po_nm_det.ppn / 100 AS ppn, 
                      dbo.tc_po_nm_det.harga_satuan, dbo.mt_supplier.namasupplier, dbo.tc_penerimaan_barang_nm_detail.tempat, dbo.mt_pabrik_nm.nama_pabrik
FROM         dbo.mt_barang_nm INNER JOIN
                      dbo.tc_permohonan_nm INNER JOIN
                      dbo.tc_po_nm_det ON dbo.tc_permohonan_nm.id_tc_permohonan = dbo.tc_po_nm_det.id_tc_permohonan ON 
                      dbo.mt_barang_nm.kode_brg = dbo.tc_po_nm_det.kode_brg INNER JOIN
                      dbo.tc_po_nm ON dbo.tc_po_nm_det.id_tc_po = dbo.tc_po_nm.id_tc_po INNER JOIN
                      dbo.tc_penerimaan_barang_nm_detail ON dbo.tc_po_nm_det.id_tc_po_det = dbo.tc_penerimaan_barang_nm_detail.id_tc_po_det INNER JOIN
                      dbo.tc_penerimaan_barang_nm ON dbo.tc_penerimaan_barang_nm_detail.kode_penerimaan = dbo.tc_penerimaan_barang_nm.kode_penerimaan INNER JOIN
                      dbo.mt_supplier ON dbo.tc_po_nm.kodesupplier = dbo.mt_supplier.kodesupplier LEFT OUTER JOIN
                      dbo.mt_pabrik_nm ON dbo.mt_barang_nm.kode_pabrik = dbo.mt_pabrik_nm.kode_pabrik
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_lap_pembelian_nm_2nd_v]");
    }
};
