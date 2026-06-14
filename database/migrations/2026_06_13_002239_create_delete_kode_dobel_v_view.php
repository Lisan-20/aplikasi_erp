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
        DB::statement("CREATE OR ALTER VIEW dbo.delete_kode_dobel_v
AS
SELECT     COUNT(kode_brg) AS Expr1, kode_bagian, kode_brg, MIN(kode_depo_stok) AS kode
FROM         dbo.mt_depo_stok
GROUP BY kode_bagian, kode_brg
HAVING      (COUNT(kode_brg) > 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [delete_kode_dobel_v]");
    }
};
