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
        DB::statement("CREATE OR ALTER VIEW dbo.v_harga_barang_po_nm_terbaru
AS
SELECT     TOP (100) PERCENT dbo.tc_po_nm_det.kode_brg, dbo.tc_po_nm_det.harga_satuan AS harga_satuan_netto, dbo.tc_po_nm.kodesupplier, 
                      dbo.mt_supplier.namasupplier, dbo.mt_barang_jasa.nama_brg, dbo.tc_po_nm.no_po, dbo.tc_po_nm.id_tc_po, dbo.tc_po_nm_det.id_tc_po_det, 
                      dbo.tc_po_nm_det.satuan
FROM         dbo.tc_po_nm INNER JOIN
                      dbo.tc_po_nm_det ON dbo.tc_po_nm.id_tc_po = dbo.tc_po_nm_det.id_tc_po INNER JOIN
                      dbo.mt_supplier ON dbo.tc_po_nm.kodesupplier = dbo.mt_supplier.kodesupplier INNER JOIN
                      dbo.mt_barang_jasa ON dbo.tc_po_nm_det.kode_brg = dbo.mt_barang_jasa.kode_brg
WHERE     (dbo.tc_po_nm_det.harga_satuan > 0)
ORDER BY dbo.tc_po_nm.id_tc_po DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_harga_barang_po_nm_terbaru]");
    }
};
