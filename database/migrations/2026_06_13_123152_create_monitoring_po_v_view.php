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
        DB::statement("CREATE VIEW dbo.monitoring_po_v
AS
SELECT     TOP (100) PERCENT a.id_tc_permohonan, a.kode_permohonan, a.tgl_permohonan, COUNT(b.id_tc_permohonan_det) AS jml_brg, c.kodesupplier, c.namasupplier, dbo.tc_po_view.no_po, 
                      dbo.tc_po_view.tgl_po, dbo.tc_po_view.no_acc, dbo.tc_po_view.tgl_acc, dbo.tc_po_view.user_id_acc, dbo.tc_po_view.status_batal, YEAR(a.tgl_permohonan) AS Expr1, 
                      dbo.tc_po_view.jumlah_brg_po, dbo.tc_po_view.id_tc_po, a.kode_bagian, a.flag_is
FROM         dbo.tc_permohonan AS a INNER JOIN
                      dbo.tc_permohonan_det AS b ON b.id_tc_permohonan = a.id_tc_permohonan LEFT OUTER JOIN
                      dbo.tc_po_view ON a.id_tc_permohonan = dbo.tc_po_view.id_tc_permohonan LEFT OUTER JOIN
                      dbo.mt_supplier AS c ON a.kodesupplier = c.kodesupplier
GROUP BY c.kodesupplier, a.id_tc_permohonan, a.kode_permohonan, a.tgl_permohonan, c.namasupplier, dbo.tc_po_view.no_po, dbo.tc_po_view.tgl_po, dbo.tc_po_view.no_acc, dbo.tc_po_view.tgl_acc, 
                      dbo.tc_po_view.user_id_acc, dbo.tc_po_view.status_batal, YEAR(a.tgl_permohonan), dbo.tc_po_view.jumlah_brg_po, dbo.tc_po_view.id_tc_po, a.kode_bagian, a.flag_is
HAVING      (YEAR(a.tgl_permohonan) >= 2014)
ORDER BY a.tgl_permohonan DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [monitoring_po_v]");
    }
};
