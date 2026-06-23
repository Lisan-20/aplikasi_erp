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
        DB::statement("CREATE OR ALTER VIEW dbo.v_minta_barang_rev_po_nm
AS
SELECT     dbo.mt_barang_jasa.nama_brg, dbo.tc_permohonan_nm_det.kode_brg, dbo.tc_permohonan_nm_det.jumlah_besar, dbo.tc_permohonan_nm_det.jumlah_besar_acc, 
                      dbo.tc_permohonan_nm_det.status_batal, dbo.tc_permohonan_nm_det.status_po, dbo.tc_permohonan_nm_det.id_tc_permohonan, 
                      dbo.tc_permohonan_nm_det.id_tc_permohonan_det
FROM         dbo.tc_permohonan_nm_det INNER JOIN
                      dbo.mt_barang_jasa ON dbo.tc_permohonan_nm_det.kode_brg = dbo.mt_barang_jasa.kode_brg
WHERE     (dbo.tc_permohonan_nm_det.status_po IS NULL) AND (dbo.tc_permohonan_nm_det.jumlah_besar_acc > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_minta_barang_rev_po_nm]");
    }
};
