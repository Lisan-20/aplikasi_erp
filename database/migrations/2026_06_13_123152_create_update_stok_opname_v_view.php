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
        DB::statement("CREATE VIEW dbo.update_stok_opname_v
AS
SELECT     dbo.tc_stok_opname.harga_beli, dbo.tc_stok_opname.kode_brg, dbo.mt_rekap_stok.kode_brg AS Expr1, dbo.mt_rekap_stok.harga_beli AS Expr2, dbo.tc_stok_opname.kode_bagian
FROM         dbo.mt_rekap_stok INNER JOIN
                      dbo.tc_stok_opname ON dbo.mt_rekap_stok.kode_brg = dbo.tc_stok_opname.kode_brg
WHERE     (dbo.tc_stok_opname.harga_beli IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_stok_opname_v]");
    }
};
