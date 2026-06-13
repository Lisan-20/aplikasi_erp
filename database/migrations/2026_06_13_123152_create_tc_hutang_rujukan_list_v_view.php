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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_hutang_rujukan_list_v
AS
SELECT     dbo.tc_hutang_rujukan_inv.total_harga, dbo.dd_rujuk_rs.nama_rs_rujuk, dbo.tc_hutang_rujukan_inv.id_tc_hutang_rujukan_inv, 
                      dbo.tc_hutang_rujukan_vcr.tgl_invoice, dbo.tc_hutang_rujukan_vcr.tgl_jt, dbo.tc_hutang_rujukan_vcr.no_voucher, 
                      dbo.tc_hutang_rujukan_vcr.id_tc_hutang_rujukan_vcr, dbo.dd_rujuk_rs.id_dd_rujuk_rs
FROM         dbo.tc_hutang_rujukan_inv INNER JOIN
                      dbo.tc_hutang_rujukan_vcr ON dbo.tc_hutang_rujukan_inv.id_tc_hutang_rujukan_vcr = dbo.tc_hutang_rujukan_vcr.id_tc_hutang_rujukan_vcr INNER JOIN
                      dbo.dd_rujuk_rs ON dbo.tc_hutang_rujukan_vcr.id_dd_rujuk_rs = dbo.dd_rujuk_rs.id_dd_rujuk_rs
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_hutang_rujukan_list_v]");
    }
};
