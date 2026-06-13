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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_po_detail_v
AS
SELECT     dbo.tc_po.no_po, dbo.tc_po.tgl_po, dbo.tc_po_det.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_po_det.jumlah_besar, dbo.tc_po_det.[content], dbo.tc_po_det.harga_satuan, 
                      dbo.tc_po_det.jumlah_harga, dbo.tc_po_det.discount, dbo.tc_po_det.bonus_besar, dbo.tc_po_det.bonus_kecil, dbo.tc_po_det.discount_rp, dbo.tc_po_det.discount_psn, dbo.tc_po_det.status_close, 
                      dbo.tc_po.id_tc_po, dbo.mt_barang.satuan_besar, dbo.tc_po_det.id_tc_po_det, dbo.tc_po_det.pilih_satuan, dbo.mt_barang.satuan_kecil, dbo.tc_po_det.ppn, dbo.tc_po_det.harga_satuan_netto, 
                      dbo.tc_po_det.jumlah_harga_netto, dbo.tc_po.kodesupplier, dbo.tc_po_det.satuan, dbo.tc_po_det.tgl_batal, dbo.tc_po_det.user_batal, dbo.tc_po.status_batal AS stat_batal, dbo.tc_po.tgl_acc, 
                      dbo.tc_po_det.status_batal, dbo.tc_po_det.jumlah_besar_acc, dbo.mt_barang.flag_medis, dbo.tc_po.kode_bagian, dbo.tc_po.flag_is
FROM         dbo.tc_po INNER JOIN
                      dbo.tc_po_det ON dbo.tc_po.id_tc_po = dbo.tc_po_det.id_tc_po INNER JOIN
                      dbo.mt_barang ON dbo.tc_po_det.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
WHERE     (dbo.tc_po_det.jumlah_besar > 0) AND (dbo.tc_po.tgl_acc IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_po_detail_v]");
    }
};
