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
        DB::statement("CREATE VIEW dbo.upd_ref_kartu_hutang_v
AS
SELECT     dbo.bd_tc_trans.no_bukti, dbo.tc_hutang_supplier_vcr.no_voucher, dbo.tx_harian.referensi, dbo.bd_tc_trans.no_ref
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.tc_hutang_supplier_vcr ON dbo.bd_tc_trans.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.tx_harian ON dbo.bd_tc_trans.no_bukti = dbo.tx_harian.no_bukti
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_ref_kartu_hutang_v]");
    }
};
