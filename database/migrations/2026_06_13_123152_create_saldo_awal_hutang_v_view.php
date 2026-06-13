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
        DB::statement("CREATE VIEW dbo.saldo_awal_hutang_v
AS
SELECT     TOP (100) PERCENT SUM(dbo.tc_hutang_supplier_inv.total_harga) AS hutang, dbo.mt_supplier.namasupplier, dbo.bd_tc_trans.id_tc_hutang_supplier_inv, 
                      dbo.tc_hutang_supplier_vcr.no_voucher, dbo.tc_hutang_supplier_vcr.tgl_invoice, dbo.tc_hutang_supplier_vcr.kodesupplier
FROM         dbo.tc_hutang_supplier_inv INNER JOIN
                      dbo.tc_hutang_supplier_vcr ON dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.mt_supplier ON dbo.tc_hutang_supplier_vcr.kodesupplier = dbo.mt_supplier.kodesupplier LEFT OUTER JOIN
                      dbo.bd_tc_trans ON dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_inv = dbo.bd_tc_trans.id_tc_hutang_supplier_inv
WHERE     (MONTH(dbo.tc_hutang_supplier_vcr.tgl_invoice) <= 12) AND (YEAR(dbo.tc_hutang_supplier_vcr.tgl_invoice) = 2013)
GROUP BY dbo.mt_supplier.namasupplier, dbo.bd_tc_trans.id_tc_hutang_supplier_inv, dbo.tc_hutang_supplier_vcr.no_voucher, dbo.tc_hutang_supplier_vcr.tgl_invoice, 
                      dbo.tc_hutang_supplier_vcr.kodesupplier
HAVING      (dbo.bd_tc_trans.id_tc_hutang_supplier_inv IS NULL)
ORDER BY dbo.mt_supplier.namasupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [saldo_awal_hutang_v]");
    }
};
