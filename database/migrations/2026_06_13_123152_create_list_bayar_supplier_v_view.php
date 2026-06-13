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
        DB::statement("CREATE VIEW dbo.list_bayar_supplier_v
AS
SELECT     dbo.mt_supplier.namasupplier, dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.jumlah, dbo.mt_supplier.kodesupplier, dbo.bd_tc_trans.tgl_transaksi, dbo.bd_tc_trans.penerima, dbo.bd_tc_trans.uraian, 
                      dbo.bd_tc_trans.id_bd_tc_trans, dbo.mt_supplier.id_mt_supplier
FROM         dbo.mt_supplier INNER JOIN
                      dbo.tc_hutang_supplier_vcr ON dbo.mt_supplier.kodesupplier = dbo.tc_hutang_supplier_vcr.kodesupplier INNER JOIN
                      dbo.bd_tc_trans ON dbo.tc_hutang_supplier_vcr.id_bd_tc_trans = dbo.bd_tc_trans.id_bd_tc_trans
GROUP BY dbo.mt_supplier.namasupplier, dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.jumlah, dbo.mt_supplier.kodesupplier, dbo.bd_tc_trans.tgl_transaksi, dbo.bd_tc_trans.penerima, dbo.bd_tc_trans.uraian, 
                      dbo.bd_tc_trans.id_bd_tc_trans, dbo.mt_supplier.id_mt_supplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [list_bayar_supplier_v]");
    }
};
