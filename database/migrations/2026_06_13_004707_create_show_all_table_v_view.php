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
        DB::statement("CREATE OR ALTER VIEW dbo.show_all_table_v
AS
SELECT     TABLE_CATALOG, TABLE_SCHEMA, TABLE_NAME, TABLE_TYPE
FROM         INFORMATION_SCHEMA.TABLES
WHERE     (TABLE_TYPE = 'BASE TABLE') AND (TABLE_NAME LIKE '%transaksi%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [show_all_table_v]");
    }
};
