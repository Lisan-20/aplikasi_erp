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
        DB::statement("CREATE OR ALTER VIEW dbo.penerimaan_brg_det_lagi_v
AS
SELECT     a.no_po, a.tgl_po, a.kode_brg, a.nama_brg, CASE WHEN jumlah_besar_acc IS NULL THEN 0 ELSE jumlah_besar_acc END AS jumlah_besar, a.[content], a.harga_satuan, a.jumlah_harga, 
                      a.discount, a.bonus_besar, a.bonus_kecil, a.discount_rp, a.discount_psn, a.status_batal, a.status_close, a.id_tc_po, a.satuan_besar, a.id_tc_po_det, SUM(CASE WHEN b.jumlah_kirim IS NULL 
                      THEN 0 ELSE b.jumlah_kirim END) AS jumlah_sdh_terima, YEAR(a.tgl_po) AS tahun, a.kodesupplier, dbo.mt_supplier.namasupplier, a.stat_batal, a.flag_medis, a.kode_bagian, a.flag_is
FROM         dbo.tc_po_detail_v AS a INNER JOIN
                      dbo.mt_supplier ON a.kodesupplier = dbo.mt_supplier.kodesupplier LEFT OUTER JOIN
                      dbo.tc_penerimaan_barang_detail AS b ON b.id_tc_po_det = a.id_tc_po_det
WHERE     (a.status_close IS NULL)
GROUP BY a.no_po, a.tgl_po, a.kode_brg, a.nama_brg, CASE WHEN jumlah_besar_acc IS NULL THEN 0 ELSE jumlah_besar_acc END, a.[content], a.harga_satuan, a.jumlah_harga, a.discount, 
                      a.bonus_besar, a.bonus_kecil, a.discount_rp, a.discount_psn, a.status_batal, a.status_close, a.id_tc_po, a.satuan_besar, a.id_tc_po_det, YEAR(a.tgl_po), a.kodesupplier, 
                      dbo.mt_supplier.namasupplier, a.stat_batal, a.flag_medis, a.kode_bagian, a.flag_is
HAVING      (a.stat_batal = 2) AND (CASE WHEN jumlah_besar_acc IS NULL THEN 0 ELSE jumlah_besar_acc END > SUM(CASE WHEN jumlah_kirim IS NULL THEN 0 ELSE jumlah_kirim END))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_brg_det_lagi_v]");
    }
};
