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
        DB::statement("CREATE VIEW dbo.kartu_stok_akhir_v
AS
SELECT     TOP (1) PERCENT 1 AS Expr2, '2024/01/01 00:00:00.000' AS Expr1, kode_brg, stok_akhir, kode_bagian, MAX(id_kartu) AS Expr3
FROM         dbo.tc_kartu_stok
GROUP BY kode_brg, YEAR(tgl_input), MONTH(tgl_input), stok_akhir, kode_bagian
HAVING      (YEAR(tgl_input) = 2023) AND (MONTH(tgl_input) = 12)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kartu_stok_akhir_v]");
    }
};
