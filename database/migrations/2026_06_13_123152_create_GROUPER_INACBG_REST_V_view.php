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
        DB::statement("CREATE VIEW dbo.GROUPER_INACBG_REST_V
AS
SELECT     SUM(TotalTarif) AS Tarif, NoSep, no_mr
FROM         dbo.GROUPER_INACBG_REST
GROUP BY NoSep, no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [GROUPER_INACBG_REST_V]");
    }
};
