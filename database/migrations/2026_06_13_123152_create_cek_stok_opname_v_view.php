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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_stok_opname_v
AS
SELECT     TOP (100) PERCENT COUNT(kode_brg) AS jumlah, tgl_stok_opname, kode_bagian, kode_brg
FROM         dbo.tc_stok_opname
GROUP BY tgl_stok_opname, kode_bagian, kode_brg
HAVING      (kode_bagian = '060201') AND (COUNT(kode_brg) >= 2)
ORDER BY kode_bagian, tgl_stok_opname, kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_stok_opname_v]");
    }
};
