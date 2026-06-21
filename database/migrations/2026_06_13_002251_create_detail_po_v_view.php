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
        DB::statement("CREATE OR ALTER VIEW dbo.detail_po_v
AS
SELECT     MAX(id_tc_po_det) AS Expr1, kode_brg
FROM         dbo.tc_po_det
GROUP BY kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [detail_po_v]");
    }
};
