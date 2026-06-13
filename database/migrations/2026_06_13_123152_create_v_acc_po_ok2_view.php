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
        DB::statement("CREATE VIEW dbo.v_acc_po_ok2
AS
SELECT     TOP (100) PERCENT dbo.tc_po.tgl_po, dbo.tc_po.no_po, dbo.tc_po.id_tc_po, dbo.tc_po_det_v.jml, dbo.mt_supplier.namasupplier, dbo.mt_supplier.kodesupplier, dbo.tc_po.tgl_pengajuan_po, 
                      dbo.tc_po.no_pengajuan_po, dbo.tc_po.status_batal, dbo.tc_po.kode_bagian, dbo.tc_po.flag_is
FROM         dbo.tc_po INNER JOIN
                      dbo.tc_po_det_v ON dbo.tc_po.id_tc_po = dbo.tc_po_det_v.id_tc_po LEFT OUTER JOIN
                      dbo.mt_supplier ON dbo.tc_po.kodesupplier = dbo.mt_supplier.kodesupplier
WHERE     (YEAR(dbo.tc_po.tgl_pengajuan_po) >= 2024)
GROUP BY dbo.tc_po.no_po, dbo.tc_po.id_tc_po, dbo.tc_po.tgl_po, dbo.tc_po.no_acc, dbo.tc_po_det_v.jml, dbo.mt_supplier.namasupplier, dbo.mt_supplier.kodesupplier, dbo.tc_po.tgl_pengajuan_po, 
                      dbo.tc_po.no_pengajuan_po, dbo.tc_po.status_batal, dbo.tc_po.kode_bagian, dbo.tc_po.flag_is
HAVING      (dbo.tc_po.no_acc IS NOT NULL) AND (dbo.tc_po.status_batal = 3)
ORDER BY dbo.tc_po.tgl_po DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_acc_po_ok2]");
    }
};
