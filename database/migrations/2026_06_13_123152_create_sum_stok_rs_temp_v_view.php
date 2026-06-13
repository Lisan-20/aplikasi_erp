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
        DB::statement("CREATE VIEW dbo.sum_stok_rs_temp_v
AS
SELECT     TOP (100) PERCENT COUNT(kode_brg) AS Expr1, bagian, kode_brg
FROM         dbo.stok_rs_temp
GROUP BY bagian, kode_brg
HAVING      (COUNT(kode_brg) > 1)
ORDER BY bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_stok_rs_temp_v]");
    }
};
