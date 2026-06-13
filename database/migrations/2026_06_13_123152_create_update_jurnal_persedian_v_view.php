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
        DB::statement("CREATE VIEW dbo.update_jurnal_persedian_v
AS
SELECT     dbo.tc_permintaan_inst_det.tgl_ver, dbo.tc_permintaan_inst_det.status_ver, dbo.tc_permintaan_inst.nomor_permintaan, dbo.tc_permintaan_inst.tgl_permintaan
FROM         dbo.tc_permintaan_inst INNER JOIN
                      dbo.tc_permintaan_inst_det ON dbo.tc_permintaan_inst.id_tc_permintaan_inst = dbo.tc_permintaan_inst_det.id_tc_permintaan_inst
WHERE     (dbo.tc_permintaan_inst_det.status_ver = 1) AND (dbo.tc_permintaan_inst.nomor_permintaan LIKE '%RS/AU%') AND (YEAR(dbo.tc_permintaan_inst.tgl_permintaan) = 2017)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_jurnal_persedian_v]");
    }
};
