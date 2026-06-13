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
        DB::statement("CREATE VIEW dbo.stock_opname_farmasi
AS
SELECT     kode_bagian, kode_brg, YEAR(tgl_stok_opname) AS Expr1
FROM         dbo.tc_stok_opname
GROUP BY kode_bagian, kode_brg, YEAR(tgl_stok_opname)
HAVING      (kode_bagian = '060101') AND (YEAR(tgl_stok_opname) = 2015)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [stock_opname_farmasi]");
    }
};
