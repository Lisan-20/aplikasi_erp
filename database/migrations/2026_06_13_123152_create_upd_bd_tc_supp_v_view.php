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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_bd_tc_supp_v
AS
SELECT     dbo.tc_hutang_supplier_vcr.id_bd_tc_trans AS satu, dbo.tc_hutang_supplier_inv.id_bd_tc_trans AS dua, dbo.bd_tc_trans.id_bd_tc_trans AS id_bayar
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.tc_hutang_supplier_vcr ON dbo.bd_tc_trans.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.tc_hutang_supplier_inv ON dbo.bd_tc_trans.id_tc_hutang_supplier_inv = dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_inv
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_bd_tc_supp_v]");
    }
};
