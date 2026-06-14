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
        DB::statement("CREATE OR ALTER VIEW dbo.bukti_supplier_bayar_v
AS
SELECT     SUM(dbo.tc_hutang_supplier_inv.total_harga) AS jml_hutang, SUM(dbo.bd_tc_trans.jumlah) AS jml_bayar, dbo.tc_hutang_supplier_inv.id_bd_tc_trans, dbo.bd_tc_trans.no_bukti
FROM         dbo.tc_hutang_supplier_inv INNER JOIN
                      dbo.bd_tc_trans ON dbo.tc_hutang_supplier_inv.id_bd_tc_trans = dbo.bd_tc_trans.id_bd_tc_trans
GROUP BY dbo.tc_hutang_supplier_inv.id_bd_tc_trans, dbo.bd_tc_trans.no_bukti
HAVING      (dbo.tc_hutang_supplier_inv.id_bd_tc_trans > 0) AND (SUM(dbo.tc_hutang_supplier_inv.total_harga) <> SUM(dbo.bd_tc_trans.jumlah))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bukti_supplier_bayar_v]");
    }
};
