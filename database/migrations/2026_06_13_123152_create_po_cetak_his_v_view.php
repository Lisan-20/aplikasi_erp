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
        DB::statement("CREATE VIEW dbo.po_cetak_his_v
AS
SELECT     TOP (100) PERCENT dbo.tc_po_det.id_tc_po_det, dbo.tc_po_det.id_tc_po, dbo.tc_po.no_po, dbo.tc_po.tgl_po, dbo.tc_po.batas_tgl_kirim, dbo.tc_po_det.kode_brg, dbo.mt_barang.nama_brg, 
                      dbo.tc_po_det.jumlah_besar, dbo.mt_barang.satuan_besar, dbo.mt_barang.satuan_kecil, dbo.tc_po_det.[content], dbo.tc_po_det.harga_satuan, dbo.tc_po_det.harga_satuan_netto, 
                      dbo.tc_po_det.jumlah_harga, dbo.tc_po_det.jumlah_besar_acc, dbo.tc_po_det.jumlah_harga_netto, dbo.tc_po_det.ppn, dbo.tc_po.term_of_pay, dbo.tc_po_det.pilih_satuan, dbo.tc_po_det.discount, 
                      dbo.tc_po_det.bonus_besar, dbo.tc_po_det.bonus_kecil, dbo.tc_po_det.discount_rp, dbo.tc_po_det.discount_psn
FROM         dbo.mt_barang INNER JOIN
                      dbo.tc_po_det ON dbo.mt_barang.kode_brg = dbo.tc_po_det.kode_brg INNER JOIN
                      dbo.tc_po ON dbo.tc_po_det.id_tc_po = dbo.tc_po.id_tc_po
WHERE     (dbo.tc_po_det.jumlah_besar_acc > 0)
ORDER BY dbo.mt_barang.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [po_cetak_his_v]");
    }
};
