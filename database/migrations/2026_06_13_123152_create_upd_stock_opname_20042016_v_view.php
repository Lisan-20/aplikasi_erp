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
        DB::statement("CREATE VIEW dbo.upd_stock_opname_20042016_v
AS
SELECT        dbo.tc_stok_opname.kode_brg, dbo.tc_stok_opname.tgl_stok_opname, YEAR(dbo.tc_stok_opname.tgl_stok_opname) AS thn, MONTH(dbo.tc_stok_opname.tgl_stok_opname) AS bln, 
                         DAY(dbo.tc_stok_opname.tgl_stok_opname) AS tgl, dbo.mt_rekap_stok.harga_beli, dbo.tc_stok_opname.harga_beli AS harga
FROM            dbo.tc_stok_opname INNER JOIN
                         dbo.mt_rekap_stok ON dbo.tc_stok_opname.kode_brg = dbo.mt_rekap_stok.kode_brg
WHERE        (DAY(dbo.tc_stok_opname.tgl_stok_opname) = 20) AND (MONTH(dbo.tc_stok_opname.tgl_stok_opname) = 4) AND (YEAR(dbo.tc_stok_opname.tgl_stok_opname) = 2016)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_stock_opname_20042016_v]");
    }
};
