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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_hutang_supplier_union_v
AS
SELECT     *
FROM         tc_hutang_supplier_v
UNION
SELECT     *
FROM         tc_hutang_supplier_nm2_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_hutang_supplier_union_v]");
    }
};
