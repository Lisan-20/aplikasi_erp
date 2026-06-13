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
        DB::statement("CREATE VIEW dbo.ref_harga_po_nm_v
AS
SELECT     dbo.tc_po_nm_det.kode_brg, dbo.tc_po_nm_det.harga_satuan_netto, dbo.tc_po_nm_det.harga_satuan, DAY(dbo.tc_po_nm.tgl_po) AS tgl, MONTH(dbo.tc_po_nm.tgl_po) AS bln, 
                      YEAR(dbo.tc_po_nm.tgl_po) AS thn, dbo.tc_po_nm.tgl_po
FROM         dbo.tc_po_nm INNER JOIN
                      dbo.tc_po_nm_det ON dbo.tc_po_nm.id_tc_po = dbo.tc_po_nm_det.id_tc_po
WHERE     (dbo.tc_po_nm.kode_bagian IN ('070201', '070101'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ref_harga_po_nm_v]");
    }
};
