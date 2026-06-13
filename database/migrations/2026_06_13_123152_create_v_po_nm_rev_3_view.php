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
        DB::statement("CREATE VIEW dbo.v_po_nm_rev_3
AS
SELECT     *
FROM         v_po_nm_rev_1
UNION
SELECT     *
FROM         v_po_nm_rev
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_po_nm_rev_3]");
    }
};
