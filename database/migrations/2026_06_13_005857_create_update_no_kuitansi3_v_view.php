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
        DB::statement("CREATE OR ALTER VIEW dbo.update_no_kuitansi3_v
AS
SELECT     no, seri_kuitansi, no_kuitansi, tgl, bln, thn, Expr1, Expr2, nokui, nokui + no AS noBaru
FROM         dbo.update_no_kuitansi2_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_no_kuitansi3_v]");
    }
};
