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
        DB::statement("

CREATE VIEW dbo.tc_proses_pembayaran_supp_list_v
AS
SELECT     dbo.tc_hutang_supplier_inv.total_harga, dbo.mt_supplier.namasupplier, dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_inv, 
                      dbo.tc_hutang_supplier_vcr.tgl_invoice, dbo.tc_hutang_supplier_vcr.tgl_jt, dbo.tc_hutang_supplier_vcr.no_voucher, 
                      dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr, SUM(dbo.bd_tc_trans.jumlah) AS jumlah_bayar, 
                      dbo.tc_hutang_supplier_inv.total_harga - SUM(dbo.bd_tc_trans.jumlah) AS sisa
FROM         dbo.tc_hutang_supplier_inv INNER JOIN
                      dbo.tc_hutang_supplier_vcr ON 
                      dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.mt_supplier ON dbo.tc_hutang_supplier_vcr.kodesupplier = dbo.mt_supplier.kodesupplier INNER JOIN
                      dbo.bd_tc_trans ON dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr = dbo.bd_tc_trans.id_tc_hutang_supplier_vcr
GROUP BY dbo.tc_hutang_supplier_inv.total_harga, dbo.mt_supplier.namasupplier, dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_inv, 
                      dbo.tc_hutang_supplier_vcr.tgl_invoice, dbo.tc_hutang_supplier_vcr.tgl_jt, dbo.tc_hutang_supplier_vcr.no_voucher, 
                      dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_proses_pembayaran_supp_list_v]");
    }
};
