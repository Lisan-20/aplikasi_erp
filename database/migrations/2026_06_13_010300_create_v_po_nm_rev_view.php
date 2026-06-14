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
        DB::statement("CREATE OR ALTER VIEW dbo.v_po_nm_rev
AS
SELECT     dbo.tc_po_nm.tgl_po, dbo.tc_po_nm_det.kode_brg, dbo.tc_po_nm_det.harga_satuan, dbo.tc_po_nm_det.satuan, dbo.tc_po_nm_det.pilih_satuan, 
                      dbo.tc_po_nm.kodesupplier, MAX(dbo.tc_po_nm_det.id_tc_po_det) AS id_tc_po_det
FROM         dbo.tc_po_nm INNER JOIN
                      dbo.tc_po_nm_det ON dbo.tc_po_nm.id_tc_po = dbo.tc_po_nm_det.id_tc_po
GROUP BY dbo.tc_po_nm.tgl_po, dbo.tc_po_nm_det.kode_brg, dbo.tc_po_nm_det.harga_satuan, dbo.tc_po_nm_det.satuan, dbo.tc_po_nm_det.pilih_satuan, 
                      dbo.tc_po_nm.kodesupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_po_nm_rev]");
    }
};
