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
        DB::statement("CREATE VIEW dbo.harga_terbaru_v
AS
SELECT     TOP (100) PERCENT dbo.tc_po_det.kode_brg, dbo.tc_po_det.harga_satuan, dbo.tc_po_det.[content], dbo.tc_po_det.jumlah_besar, dbo.tc_po.kodesupplier
FROM         dbo.tc_po INNER JOIN
                      dbo.tc_po_det ON dbo.tc_po.id_tc_po = dbo.tc_po_det.id_tc_po
ORDER BY dbo.tc_po.tgl_po DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [harga_terbaru_v]");
    }
};
