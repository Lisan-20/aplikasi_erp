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
        DB::statement("CREATE VIEW dbo.tc_po_nm_view
AS
SELECT     dbo.tc_po_nm.no_po, dbo.tc_po_nm.tgl_po, dbo.tc_po_nm.tgl_acc, dbo.tc_po_nm.no_acc, dbo.tc_po_nm_det.id_tc_permohonan, dbo.tc_po_nm.user_id_acc, 
                      dbo.tc_po_nm_det.status_batal, COUNT(dbo.tc_po_nm_det.id_tc_po_det) AS jumlah_brg_po, dbo.tc_po_nm.id_tc_po
FROM         dbo.tc_po_nm INNER JOIN
                      dbo.tc_po_nm_det ON dbo.tc_po_nm.id_tc_po = dbo.tc_po_nm_det.id_tc_po
GROUP BY dbo.tc_po_nm.no_po, dbo.tc_po_nm.tgl_po, dbo.tc_po_nm.tgl_acc, dbo.tc_po_nm.no_acc, dbo.tc_po_nm_det.id_tc_permohonan, dbo.tc_po_nm.user_id_acc, 
                      dbo.tc_po_nm_det.status_batal, dbo.tc_po_nm.id_tc_po
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_po_nm_view]");
    }
};
