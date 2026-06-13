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
        DB::statement("
CREATE VIEW dbo.tc_retur_unit_v
AS
SELECT     dbo.mt_barang.nama_brg, dbo.tc_retur_unit_det.jumlah, dbo.tc_retur_unit_det.jml_sebelum, dbo.tc_retur_unit_det.alasan, 
                      dbo.tc_retur_unit_det.kode_retur, dbo.tc_retur_unit_det.kode_brg
FROM         dbo.mt_barang INNER JOIN
                      dbo.tc_retur_unit_det ON dbo.mt_barang.kode_brg = dbo.tc_retur_unit_det.kode_brg

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_retur_unit_v]");
    }
};
