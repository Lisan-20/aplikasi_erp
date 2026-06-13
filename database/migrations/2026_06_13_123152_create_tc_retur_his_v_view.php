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
        DB::statement("CREATE VIEW dbo.tc_retur_his_v
AS
SELECT     dbo.tc_retur_unit.id_tc_retur_unit, dbo.tc_retur_unit.kode_retur, dbo.tc_retur_unit.kode_bagian, dbo.tc_retur_unit.tgl_retur, dbo.tc_retur_unit.status, 
                      dbo.tc_retur_unit.no_induk, dbo.tc_retur_unit.tgl_input, dbo.tc_retur_unit.petugas_unit, dbo.tc_retur_unit.petugas_gudang, dbo.mt_bagian.nama_bagian, 
                      dbo.tc_retur_unit_det.kode_brg
FROM         dbo.tc_retur_unit INNER JOIN
                      dbo.mt_bagian ON dbo.tc_retur_unit.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_retur_unit_det ON dbo.tc_retur_unit.kode_retur = dbo.tc_retur_unit_det.kode_retur
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_retur_his_v]");
    }
};
