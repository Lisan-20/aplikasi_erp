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
        DB::statement("CREATE OR ALTER VIEW dbo.tgl_upd
AS
SELECT     dbo.tc_referensi.tgl_ref, dbo.tc_referensi_det.tgl_ref AS tgl_ref_up
FROM         dbo.tc_referensi INNER JOIN
                      dbo.tc_referensi_det ON dbo.tc_referensi.id_tc_ref = dbo.tc_referensi_det.id_tc_ref
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tgl_upd]");
    }
};
