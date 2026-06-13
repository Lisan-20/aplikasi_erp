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
        DB::statement("CREATE VIEW dbo.update_lunas_supplier_v
AS
SELECT     dbo.tc_hutang_supp_v.jml_hutang, dbo.bd_tc_bayar_supp_v.jml_bayar, dbo.tc_hutang_supp_v.id_bd_tc_trans
FROM         dbo.tc_hutang_supp_v INNER JOIN
                      dbo.bd_tc_bayar_supp_v ON dbo.tc_hutang_supp_v.id_bd_tc_trans = dbo.bd_tc_bayar_supp_v.id_bd_tc_trans
WHERE     (dbo.tc_hutang_supp_v.id_bd_tc_trans > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_lunas_supplier_v]");
    }
};
