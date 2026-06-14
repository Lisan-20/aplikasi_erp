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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pembayaran_supplier_v
AS
SELECT     dbo.tc_hutang_supplier_inv.total_harga, dbo.mt_supplier.namasupplier, dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_inv, dbo.tc_hutang_supplier_vcr.tgl_invoice, 
                      dbo.tc_hutang_supplier_vcr.tgl_jt, dbo.tc_hutang_supplier_vcr.no_voucher, dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr, dbo.tc_hutang_supplier_inv.id_bd_tc_trans AS status, 
                      dbo.mt_supplier.id_mt_supplier, dbo.bd_tc_trans.jumlah, dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.tgl_transaksi, dbo.mt_supplier.kodesupplier, 
                      dbo.tc_hutang_supplier_inv.no_voucher AS no_faktur, dbo.tc_hutang_supplier_inv.flag_ver, dbo.tc_hutang_supplier_inv.status_ver, dbo.mt_supplier.flag_gizi, dbo.mt_supplier.flag_sup, 
                      dbo.tc_hutang_supplier_vcr.id_bd_tc_trans, dbo.bd_tc_trans.id_bd_tc_trans AS id_bayar, dbo.tc_hutang_supplier_inv.lunas, dbo.tc_hutang_supplier_inv.id_dd_user, dbo.dd_user.username
FROM         dbo.tc_hutang_supplier_inv INNER JOIN
                      dbo.tc_hutang_supplier_vcr ON dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.mt_supplier ON dbo.tc_hutang_supplier_vcr.kodesupplier = dbo.mt_supplier.kodesupplier LEFT OUTER JOIN
                      dbo.dd_user ON dbo.tc_hutang_supplier_inv.id_dd_user = dbo.dd_user.id_dd_user LEFT OUTER JOIN
                      dbo.bd_tc_trans ON dbo.tc_hutang_supplier_inv.id_bd_tc_trans = dbo.bd_tc_trans.id_bd_tc_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pembayaran_supplier_v]");
    }
};
