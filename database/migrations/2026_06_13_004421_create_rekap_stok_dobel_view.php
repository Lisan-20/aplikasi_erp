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
        DB::statement("CREATE OR ALTER VIEW dbo.rekap_stok_dobel
AS
SELECT     kode_brg, COUNT(kode_rekap_stok) AS Expr1
FROM         dbo.mt_rekap_stok
GROUP BY kode_brg
HAVING      (COUNT(kode_rekap_stok) > 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rekap_stok_dobel]");
    }
};
