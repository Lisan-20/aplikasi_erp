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
        DB::statement("CREATE VIEW dbo.tc_po_union_v
AS
SELECT     no_po, tgl_po, kodesupplier, id_tc_po, no_acc
FROM         tc_po
UNION
SELECT     no_po, tgl_po, kodesupplier, id_tc_po, no_acc
FROM         tc_po_nm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_po_union_v]");
    }
};
