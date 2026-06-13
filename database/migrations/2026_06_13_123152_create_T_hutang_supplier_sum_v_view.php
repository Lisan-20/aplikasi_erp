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
        DB::statement("CREATE VIEW dbo.T_hutang_supplier_sum_v
AS
SELECT     TOP (100) PERCENT SUM(dbo.T_Hutang_Supplier_v.tx_nominal) AS total, dbo.T_Hutang_Supplier_v.acc_no, dbo.T_Hutang_Supplier_v.kode_supplier, YEAR(dbo.T_Hutang_Supplier_v.tx_tgl) 
                      AS tahun, MONTH(dbo.T_Hutang_Supplier_v.tx_tgl) AS bulan, dbo.mt_supplier.namasupplier
FROM         dbo.T_Hutang_Supplier_v LEFT OUTER JOIN
                      dbo.mt_supplier ON dbo.T_Hutang_Supplier_v.kode_supplier = dbo.mt_supplier.kodesupplier
GROUP BY dbo.T_Hutang_Supplier_v.acc_no, dbo.T_Hutang_Supplier_v.kode_supplier, MONTH(dbo.T_Hutang_Supplier_v.tx_tgl), YEAR(dbo.T_Hutang_Supplier_v.tx_tgl), 
                      dbo.mt_supplier.namasupplier
ORDER BY dbo.mt_supplier.namasupplier, bulan, tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [T_hutang_supplier_sum_v]");
    }
};
