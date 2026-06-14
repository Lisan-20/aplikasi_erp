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
        DB::statement("CREATE OR ALTER VIEW dbo.v_po_nm_rev_1
AS
SELECT     dbo.tc_referensi_nm_det.tgl_ref AS tgl_po, dbo.tc_referensi_nm_det.kode_brg, dbo.tc_referensi_nm_det.harga_satuan_netto AS harga_satuan, 
                      dbo.tc_referensi_nm_det.satuan, dbo.tc_referensi_nm_det.pilih_satuan, dbo.tc_referensi_nm.kodesupplier, MAX(dbo.tc_referensi_nm_det.id_tc_ref_det) 
                      AS id_tc_po_det
FROM         dbo.tc_referensi_nm_det INNER JOIN
                      dbo.tc_referensi_nm ON dbo.tc_referensi_nm_det.id_tc_ref = dbo.tc_referensi_nm.id_tc_ref
GROUP BY dbo.tc_referensi_nm_det.tgl_ref, dbo.tc_referensi_nm_det.kode_brg, dbo.tc_referensi_nm_det.harga_satuan_netto, dbo.tc_referensi_nm_det.satuan, 
                      dbo.tc_referensi_nm_det.pilih_satuan, dbo.tc_referensi_nm.kodesupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_po_nm_rev_1]");
    }
};
