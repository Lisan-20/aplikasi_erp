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
        DB::statement("CREATE VIEW dbo.harga_terbaru_nm_v
AS
SELECT     TOP (100) PERCENT dbo.tc_po_nm_det.kode_brg, dbo.tc_po_nm_det.harga_satuan, dbo.tc_po_nm_det.[content], dbo.tc_po_nm_det.jumlah_besar, 
                      dbo.tc_po_nm.kodesupplier
FROM         dbo.tc_po_nm INNER JOIN
                      dbo.tc_po_nm_det ON dbo.tc_po_nm.id_tc_po = dbo.tc_po_nm_det.id_tc_po
ORDER BY dbo.tc_po_nm.tgl_po DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [harga_terbaru_nm_v]");
    }
};
