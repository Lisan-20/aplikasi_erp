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
        DB::statement("CREATE VIEW dbo.list_po_rs_v
AS
SELECT     dbo.tc_po_det.id_tc_po, SUM(CASE WHEN harga_satuan IS NULL THEN 0 ELSE harga_satuan END * CASE WHEN jumlah_besar_acc IS NULL THEN 0 ELSE jumlah_besar_acc END) AS JmlHarga, 
                      dbo.tc_po.ket_acc, dbo.tc_po.term_of_pay
FROM         dbo.tc_po_det INNER JOIN
                      dbo.tc_po ON dbo.tc_po_det.id_tc_po = dbo.tc_po.id_tc_po
GROUP BY dbo.tc_po_det.id_tc_po, dbo.tc_po.ket_acc, dbo.tc_po.term_of_pay
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [list_po_rs_v]");
    }
};
