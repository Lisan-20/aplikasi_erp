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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_harga_stok_opname_v
AS
SELECT     dbo.tc_stok_opname.kode_brg, dbo.mt_rekap_stok.harga_persediaan, dbo.tc_stok_opname.harga_beli
FROM         dbo.tc_stok_opname INNER JOIN
                      dbo.mt_rekap_stok ON dbo.tc_stok_opname.kode_brg = dbo.mt_rekap_stok.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_harga_stok_opname_v]");
    }
};
