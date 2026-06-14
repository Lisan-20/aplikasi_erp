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
        DB::statement("CREATE OR ALTER VIEW dbo.update_tgl_ref_v
AS
SELECT     dbo.tc_referensi.tgl_ref, dbo.tc_referensi_det.tgl_ref AS tanggal, dbo.tc_referensi_det.kode_brg
FROM         dbo.tc_referensi_det INNER JOIN
                      dbo.tc_referensi ON dbo.tc_referensi_det.id_tc_ref = dbo.tc_referensi.id_tc_ref
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_tgl_ref_v]");
    }
};
