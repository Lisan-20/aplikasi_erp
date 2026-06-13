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
        DB::statement("CREATE VIEW dbo.v_po_rev_2
AS
SELECT     dbo.tc_referensi_det.kode_brg, dbo.tc_referensi_det.harga_satuan_netto AS harga_satuan, dbo.tc_referensi_det.satuan, dbo.tc_referensi_det.pilih_satuan, dbo.tc_referensi.kodesupplier, 
                      MAX(dbo.tc_referensi_det.id_tc_ref_det) AS id_tc_po_det
FROM         dbo.tc_referensi_det INNER JOIN
                      dbo.tc_referensi ON dbo.tc_referensi_det.id_tc_ref = dbo.tc_referensi.id_tc_ref
GROUP BY dbo.tc_referensi_det.kode_brg, dbo.tc_referensi_det.harga_satuan_netto, dbo.tc_referensi_det.satuan, dbo.tc_referensi_det.pilih_satuan, dbo.tc_referensi.kodesupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_po_rev_2]");
    }
};
