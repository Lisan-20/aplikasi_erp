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
        DB::statement("

CREATE OR ALTER VIEW dbo.tgl_stok_opname_v
AS
SELECT     TOP 100 PERCENT DAY(tgl_stok_opname) AS tgl, MONTH(tgl_stok_opname) AS bln, YEAR(tgl_stok_opname) AS thn
FROM         dbo.tc_stok_opname
GROUP BY DAY(tgl_stok_opname), MONTH(tgl_stok_opname), YEAR(tgl_stok_opname)
ORDER BY YEAR(tgl_stok_opname) DESC, MONTH(tgl_stok_opname) DESC, DAY(tgl_stok_opname) DESC


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tgl_stok_opname_v]");
    }
};
