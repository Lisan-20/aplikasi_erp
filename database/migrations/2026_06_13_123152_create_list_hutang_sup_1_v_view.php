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
        DB::statement("CREATE OR ALTER VIEW dbo.list_hutang_sup_1_v
AS
SELECT     dbo.tc_hutang_supplier_inv.total_harga, dbo.mt_supplier.namasupplier, dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_inv, dbo.tc_hutang_supplier_vcr.tgl_invoice, 
                      dbo.tc_hutang_supplier_vcr.tgl_jt, dbo.tc_hutang_supplier_vcr.no_voucher, dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr, dbo.mt_supplier.id_mt_supplier, dbo.mt_supplier.kodesupplier, 
                      dbo.tc_hutang_supplier_inv.no_voucher AS nofaktur, dbo.tc_hutang_supplier_inv.flag_ver, dbo.tc_hutang_supplier_inv.status_ver, dbo.tc_hutang_supplier_vcr.no_faktur
FROM         dbo.tc_hutang_supplier_inv INNER JOIN
                      dbo.tc_hutang_supplier_vcr ON dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.mt_supplier ON dbo.tc_hutang_supplier_vcr.kodesupplier = dbo.mt_supplier.kodesupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [list_hutang_sup_1_v]");
    }
};
