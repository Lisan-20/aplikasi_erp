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
        DB::statement("CREATE OR ALTER VIEW dbo.harga_po_v
AS
SELECT     TOP (100) PERCENT dbo.tc_po.tgl_po AS tgl, dbo.tc_po_det.kode_brg, dbo.tc_po_det.jumlah_besar, dbo.tc_po_det.[content] AS isi, dbo.tc_po_det.satuan, dbo.tc_po_det.harga_satuan AS harga, 
                      dbo.tc_po.kodesupplier, dbo.tc_po_det.pilih_satuan, dbo.tc_po_det.discount
FROM         dbo.tc_po INNER JOIN
                      dbo.tc_po_det ON dbo.tc_po.id_tc_po = dbo.tc_po_det.id_tc_po
WHERE     (dbo.tc_po_det.harga_satuan > 0)
ORDER BY tgl DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [harga_po_v]");
    }
};
