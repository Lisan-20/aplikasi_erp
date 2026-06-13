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
        DB::statement("CREATE VIEW dbo.grouper_inacbgs_v
AS
SELECT        NoSep, NoPeserta, no_mr, CONVERT(VARCHAR(10), TglMasuk, 103) AS TglMasuk, CONVERT(VARCHAR(10), TglKeluar, 103) AS TglKkeluar
FROM            dbo.GROUPER_INACBG_REST
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [grouper_inacbgs_v]");
    }
};
