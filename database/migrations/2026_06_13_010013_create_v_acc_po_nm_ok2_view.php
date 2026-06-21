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
        DB::statement("CREATE OR ALTER VIEW dbo.v_acc_po_nm_ok2
AS
SELECT     TOP (100) PERCENT dbo.tc_po_nm.tgl_po, dbo.tc_po_nm.no_po, dbo.tc_po_nm.id_tc_po, dbo.tc_po_nm_det_v.jml, dbo.mt_supplier.namasupplier, dbo.mt_supplier.kodesupplier, 
                      dbo.tc_po_nm.kode_bagian, dbo.tc_po_nm.status_batal
FROM         dbo.tc_po_nm INNER JOIN
                      dbo.tc_po_nm_det_v ON dbo.tc_po_nm.id_tc_po = dbo.tc_po_nm_det_v.id_tc_po LEFT OUTER JOIN
                      dbo.mt_supplier ON dbo.tc_po_nm.kodesupplier = dbo.mt_supplier.kodesupplier
WHERE     (YEAR(dbo.tc_po_nm.tgl_po) >= 2024)
GROUP BY dbo.tc_po_nm.no_po, dbo.tc_po_nm.id_tc_po, dbo.tc_po_nm.tgl_po, dbo.tc_po_nm.no_acc, dbo.tc_po_nm_det_v.jml, dbo.mt_supplier.namasupplier, dbo.mt_supplier.kodesupplier, 
                      dbo.tc_po_nm.kode_bagian, dbo.tc_po_nm.status_batal
HAVING      (dbo.tc_po_nm.no_acc IS NOT NULL) AND (dbo.tc_po_nm.status_batal IS NULL OR
                      dbo.tc_po_nm.status_batal = 0)
ORDER BY dbo.tc_po_nm.tgl_po DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_acc_po_nm_ok2]");
    }
};
