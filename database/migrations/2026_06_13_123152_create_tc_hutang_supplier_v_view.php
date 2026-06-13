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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_hutang_supplier_v
AS
SELECT     dbo.tc_hutang_supplier_vcr_det.kode_penerimaan, dbo.tc_penerimaan_barang.no_po, dbo.tc_penerimaan_barang.tgl_penerimaan, dbo.tc_hutang_supplier_inv.total_harga, 
                      dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr, dbo.tc_hutang_supplier_vcr.no_voucher, dbo.tc_hutang_supplier_vcr.no_faktur, dbo.tc_penerimaan_barang.no_faktur AS invoice, 
                      dbo.tc_hutang_supplier_vcr_det.jumlah, dbo.tc_po.tgl_po, dbo.tc_hutang_supplier_vcr.tgl_jt
FROM         dbo.tc_hutang_supplier_vcr INNER JOIN
                      dbo.tc_hutang_supplier_inv ON dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.tc_hutang_supplier_vcr_det ON dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_vcr_det.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.tc_penerimaan_barang INNER JOIN
                      dbo.tc_po ON dbo.tc_penerimaan_barang.no_po = dbo.tc_po.no_po ON dbo.tc_hutang_supplier_vcr_det.kode_penerimaan = dbo.tc_penerimaan_barang.kode_penerimaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_hutang_supplier_v]");
    }
};
