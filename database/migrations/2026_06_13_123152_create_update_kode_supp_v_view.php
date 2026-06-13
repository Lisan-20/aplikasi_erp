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
        DB::statement("CREATE VIEW dbo.update_kode_supp_v
AS
SELECT     dbo.tc_permohonan_det.id_tc_permohonan_det, dbo.tc_permohonan_det.kode_brg, dbo.tc_permohonan_det.id_tc_permohonan, dbo.tc_po_det.id_tc_po, 
                      dbo.tc_po.kodesupplier, dbo.tc_permohonan.kodesupplier AS kode_supp, dbo.tc_po.tgl_po
FROM         dbo.tc_permohonan INNER JOIN
                      dbo.tc_permohonan_det ON dbo.tc_permohonan.id_tc_permohonan = dbo.tc_permohonan_det.id_tc_permohonan INNER JOIN
                      dbo.tc_po_det ON dbo.tc_permohonan_det.id_tc_permohonan_det = dbo.tc_po_det.id_tc_permohonan_det INNER JOIN
                      dbo.tc_po ON dbo.tc_po_det.id_tc_po = dbo.tc_po.id_tc_po
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_supp_v]");
    }
};
