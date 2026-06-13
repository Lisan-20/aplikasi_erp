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
        DB::statement("CREATE OR ALTER VIEW dbo.list_hutang_sup_2_v
AS
SELECT     SUM(jumlah) AS jumlah, id_tc_hutang_supplier_inv
FROM         dbo.bd_tc_trans
GROUP BY id_tc_hutang_supplier_inv
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [list_hutang_sup_2_v]");
    }
};
