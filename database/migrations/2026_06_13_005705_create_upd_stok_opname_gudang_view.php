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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_stok_opname_gudang
AS
SELECT     dbo.mt_rekap_stok.kode_bagian_gudang, dbo.tc_stok_opname.kode_bagian, dbo.tc_stok_opname.tgl_stok_opname, MONTH(dbo.tc_stok_opname.tgl_stok_opname) 
                      AS Expr1, dbo.tc_stok_opname.kode_brg, dbo.tc_stok_opname.harga_beli, dbo.mt_rekap_stok.harga_beli AS harga_beli_upd
FROM         dbo.tc_stok_opname INNER JOIN
                      dbo.mt_rekap_stok ON dbo.tc_stok_opname.kode_brg = dbo.mt_rekap_stok.kode_brg
WHERE     (MONTH(dbo.tc_stok_opname.tgl_stok_opname) = 5) AND (dbo.tc_stok_opname.kode_bagian = '060201')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_stok_opname_gudang]");
    }
};
