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
        DB::statement("CREATE VIEW dbo.ref_harga_nm_union_v
AS
SELECT     *
FROM         ref_harga_umd_nm_v
union
SELECT     *
FROM         ref_harga_po_nm_v

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ref_harga_nm_union_v]");
    }
};
