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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_stok_opname_gudang_v
AS
SELECT     dbo.tc_stok_opname.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_stok_opname.kode_bagian
FROM         dbo.tc_stok_opname INNER JOIN
                      dbo.mt_depo_stok ON dbo.tc_stok_opname.kode_brg = dbo.mt_depo_stok.kode_brg AND 
                      dbo.tc_stok_opname.kode_bagian = dbo.mt_depo_stok.kode_bagian INNER JOIN
                      dbo.mt_barang ON dbo.tc_stok_opname.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.tc_stok_opname.kode_bagian = '060201')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_stok_opname_gudang_v]");
    }
};
