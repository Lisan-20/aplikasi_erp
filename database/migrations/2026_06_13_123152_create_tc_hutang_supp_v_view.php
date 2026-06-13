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
        DB::statement("CREATE VIEW dbo.tc_hutang_supp_v
AS
SELECT     SUM(total_harga) AS jml_hutang, id_bd_tc_trans
FROM         dbo.tc_hutang_supplier_inv
GROUP BY id_bd_tc_trans
HAVING      (id_bd_tc_trans > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_hutang_supp_v]");
    }
};
