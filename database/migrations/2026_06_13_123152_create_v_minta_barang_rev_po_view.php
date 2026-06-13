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
        DB::statement("CREATE VIEW dbo.v_minta_barang_rev_po
AS
SELECT     dbo.mt_barang.nama_brg, dbo.tc_permohonan_det.kode_brg, dbo.tc_permohonan_det.jumlah_besar, dbo.tc_permohonan_det.jumlah_besar_acc, 
                      dbo.tc_permohonan_det.status_batal, dbo.tc_permohonan_det.status_po, dbo.tc_permohonan_det.id_tc_permohonan, 
                      dbo.tc_permohonan_det.id_tc_permohonan_det
FROM         dbo.tc_permohonan_det INNER JOIN
                      dbo.mt_barang ON dbo.tc_permohonan_det.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.tc_permohonan_det.status_po IS NULL) AND (dbo.tc_permohonan_det.jumlah_besar_acc > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_minta_barang_rev_po]");
    }
};
