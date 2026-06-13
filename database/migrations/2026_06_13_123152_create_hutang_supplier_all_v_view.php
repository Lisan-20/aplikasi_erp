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
        DB::statement("CREATE VIEW dbo.hutang_supplier_all_v
AS
SELECT     dbo.penerimaan_barang_union_v.no_po, dbo.penerimaan_barang_union_v.kodesupplier, dbo.tc_po_union_v.id_tc_po, dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr, 
                      dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_inv, dbo.penerimaan_barang_union_v.kode_penerimaan
FROM         dbo.tc_hutang_supplier_vcr INNER JOIN
                      dbo.tc_hutang_supplier_inv ON dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.tc_po_union_v INNER JOIN
                      dbo.penerimaan_barang_union_v ON dbo.tc_po_union_v.no_po = dbo.penerimaan_barang_union_v.no_po AND dbo.tc_po_union_v.kodesupplier = dbo.penerimaan_barang_union_v.kodesupplier ON
                       dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr = dbo.penerimaan_barang_union_v.status_invoice
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hutang_supplier_all_v]");
    }
};
