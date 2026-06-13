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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_po_det_v
AS
SELECT     COUNT(id_tc_po_det) AS jml, id_tc_po, status_batal
FROM         dbo.tc_po_det
GROUP BY id_tc_po, status_batal
HAVING      (status_batal IS NULL OR
                      status_batal = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_po_det_v]");
    }
};
