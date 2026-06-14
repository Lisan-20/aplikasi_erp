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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pembayaran_supplier_list_v
AS
SELECT     CASE WHEN jumlah IS NULL THEN 0 ELSE jumlah END AS jumlah, dbo.list_hutang_sup_2_v.id_tc_hutang_supplier_inv, dbo.list_hutang_sup_1_v.total_harga, 
                      dbo.list_hutang_sup_1_v.namasupplier, dbo.list_hutang_sup_1_v.tgl_invoice, dbo.list_hutang_sup_1_v.tgl_jt, dbo.list_hutang_sup_1_v.no_voucher, 
                      dbo.list_hutang_sup_1_v.id_tc_hutang_supplier_vcr, dbo.list_hutang_sup_1_v.id_mt_supplier, dbo.list_hutang_sup_1_v.kodesupplier, dbo.list_hutang_sup_1_v.nofaktur, 
                      dbo.list_hutang_sup_1_v.flag_ver, dbo.list_hutang_sup_1_v.status_ver, dbo.list_hutang_sup_1_v.no_faktur, DATEDIFF(DD, dbo.list_hutang_sup_1_v.tgl_jt, GETDATE()) AS berlaku
FROM         dbo.list_hutang_sup_2_v RIGHT OUTER JOIN
                      dbo.list_hutang_sup_1_v ON dbo.list_hutang_sup_2_v.id_tc_hutang_supplier_inv = dbo.list_hutang_sup_1_v.id_tc_hutang_supplier_inv
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pembayaran_supplier_list_v]");
    }
};
