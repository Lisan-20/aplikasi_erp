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
        DB::statement("CREATE VIEW dbo.v_jurnal_penerimaan_brg_medis
AS
SELECT     dbo.tc_penerimaan_barang.kode_penerimaan, dbo.tc_penerimaan_barang.no_po, dbo.tc_penerimaan_barang_detail.kode_brg, 
                      dbo.tc_penerimaan_barang.kodesupplier, dbo.tc_penerimaan_barang.tgl_penerimaan, dbo.tc_penerimaan_barang_detail.jumlah_kirim, 
                      dbo.tc_penerimaan_barang_detail.status_ver, dbo.tc_penerimaan_barang_detail.tgl_ver, dbo.tc_po_det.harga_satuan_netto, 
                      dbo.tc_penerimaan_barang_detail.jumlah_kirim * dbo.tc_po_det.harga_satuan_netto AS harga, dbo.tc_penerimaan_barang.petugas, dbo.tc_po.user_id, 
                      dbo.tc_penerimaan_barang_detail.kode_detail_penerimaan_barang AS no_jurnal, dbo.mapping_transaksi_rs_v.kode_proses, 
                      dbo.mapping_transaksi_rs_v.kode_jenis_proses, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.mapping_transaksi_rs_v.acc_debet, 
                      dbo.mapping_transaksi_rs_v.acc_kredit, dbo.mapping_transaksi_rs_v.kode_bagian
FROM         dbo.tc_penerimaan_barang_detail INNER JOIN
                      dbo.tc_penerimaan_barang ON dbo.tc_penerimaan_barang_detail.kode_penerimaan = dbo.tc_penerimaan_barang.kode_penerimaan INNER JOIN
                      dbo.tc_po ON dbo.tc_penerimaan_barang.no_po = dbo.tc_po.no_po AND dbo.tc_penerimaan_barang.kodesupplier = dbo.tc_po.kodesupplier INNER JOIN
                      dbo.tc_po_det ON dbo.tc_po.id_tc_po = dbo.tc_po_det.id_tc_po AND dbo.tc_penerimaan_barang_detail.kode_brg = dbo.tc_po_det.kode_brg CROSS JOIN
                      dbo.mapping_transaksi_rs_v
WHERE     (dbo.tc_penerimaan_barang_detail.tgl_ver IS NOT NULL) AND (dbo.tc_po_det.harga_satuan_netto > 0) AND (dbo.tc_penerimaan_barang_detail.jumlah_kirim > 0) AND 
                      (dbo.mapping_transaksi_rs_v.kode_proses = 3) AND (dbo.mapping_transaksi_rs_v.kode_jenis_proses = 21)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_jurnal_penerimaan_brg_medis]");
    }
};
