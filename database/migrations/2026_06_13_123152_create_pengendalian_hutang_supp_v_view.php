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
        DB::statement("CREATE VIEW dbo.pengendalian_hutang_supp_v
AS
SELECT     SUM(dbo.tc_hutang_supplier_inv.total_harga) AS totalan, dbo.mt_supplier.namasupplier, dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_inv, dbo.tc_hutang_supplier_vcr.tgl_invoice, 
                      dbo.tc_hutang_supplier_vcr.tgl_jt AS tgl_jt_tempo, dbo.tc_hutang_supplier_vcr.no_voucher, dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr, 
                      dbo.bd_tc_trans.id_tc_hutang_supplier_inv AS status, dbo.mt_supplier.id_mt_supplier, dbo.bd_tc_trans.jumlah, dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.tgl_transaksi, 
                      dbo.mt_supplier.kodesupplier, dbo.tc_hutang_supplier_inv.selisih, dbo.tc_hutang_supplier_inv.total_sbl_ppn, dbo.tc_hutang_supplier_inv.total_ppn, dbo.tc_hutang_supplier_inv.diskon, 
                      dbo.tc_hutang_supplier_inv.total_harga - dbo.tc_hutang_supplier_inv.selisih AS totalan_2, DATEDIFF(dd, GETDATE(), dbo.tc_hutang_supplier_vcr.tgl_jt) AS jatuh_tempo, 
                      dbo.tc_hutang_supplier_vcr.no_faktur, YEAR(dbo.tc_hutang_supplier_vcr.tgl_invoice) AS Expr1, dbo.tc_hutang_supplier_inv.lunas
FROM         dbo.tc_hutang_supplier_inv INNER JOIN
                      dbo.tc_hutang_supplier_vcr ON dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.mt_supplier ON dbo.tc_hutang_supplier_vcr.kodesupplier = dbo.mt_supplier.kodesupplier LEFT OUTER JOIN
                      dbo.bd_tc_trans ON dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_inv = dbo.bd_tc_trans.id_tc_hutang_supplier_inv
GROUP BY dbo.mt_supplier.namasupplier, dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_inv, dbo.tc_hutang_supplier_vcr.tgl_invoice, dbo.tc_hutang_supplier_vcr.tgl_jt, 
                      dbo.tc_hutang_supplier_vcr.no_voucher, dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr, dbo.bd_tc_trans.id_tc_hutang_supplier_inv, dbo.mt_supplier.id_mt_supplier, 
                      dbo.bd_tc_trans.jumlah, dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.tgl_transaksi, dbo.mt_supplier.kodesupplier, dbo.tc_hutang_supplier_inv.selisih, dbo.tc_hutang_supplier_inv.total_sbl_ppn, 
                      dbo.tc_hutang_supplier_inv.total_ppn, dbo.tc_hutang_supplier_inv.diskon, dbo.tc_hutang_supplier_inv.total_harga - dbo.tc_hutang_supplier_inv.selisih, DATEDIFF(dd, GETDATE(), 
                      dbo.tc_hutang_supplier_vcr.tgl_jt), dbo.tc_hutang_supplier_vcr.no_faktur, YEAR(dbo.tc_hutang_supplier_vcr.tgl_invoice), dbo.tc_hutang_supplier_inv.lunas
HAVING      (YEAR(dbo.tc_hutang_supplier_vcr.tgl_invoice) >= 2015) AND (dbo.tc_hutang_supplier_inv.lunas IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pengendalian_hutang_supp_v]");
    }
};
