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
        DB::statement("CREATE OR ALTER VIEW dbo.list_po_detail_rs_v
AS
SELECT     dbo.mt_barang.barcode AS kode_produk, dbo.tc_po_det.id_tc_po, dbo.tc_po_det.harga_satuan AS harga, dbo.tc_po_det.jumlah_besar_acc AS qty, dbo.mt_barang.nama_brg AS nama_produk, 
                      dbo.tc_po_det.pilih_satuan, dbo.tc_po_det.satuan, dbo.tc_po_det.discount AS diskon
FROM         dbo.tc_po_det INNER JOIN
                      dbo.mt_barang ON dbo.tc_po_det.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.mt_barang.barcode <> '')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [list_po_detail_rs_v]");
    }
};
