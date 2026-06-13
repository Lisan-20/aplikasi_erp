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
        DB::statement("CREATE VIEW dbo.stok_opname_far_v
AS
SELECT     dbo.tc_stok_opname.kode_brg, dbo.mt_barang.nama_brg, SUM(dbo.tc_stok_opname.stok_sekarang) AS stok_sekarang, dbo.tc_stok_opname.kode_bagian, 
                      dbo.mt_barang.satuan_kecil, dbo.tc_stok_opname.harga_beli, MONTH(dbo.tc_stok_opname.tgl_stok_opname) AS bln, YEAR(dbo.tc_stok_opname.tgl_stok_opname) 
                      AS thn
FROM         dbo.tc_stok_opname INNER JOIN
                      dbo.mt_barang ON dbo.tc_stok_opname.kode_brg = dbo.mt_barang.kode_brg
GROUP BY dbo.tc_stok_opname.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_stok_opname.kode_bagian, dbo.mt_barang.satuan_kecil, dbo.tc_stok_opname.harga_beli, 
                      MONTH(dbo.tc_stok_opname.tgl_stok_opname), YEAR(dbo.tc_stok_opname.tgl_stok_opname)
HAVING      (dbo.tc_stok_opname.kode_bagian = '060101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [stok_opname_far_v]");
    }
};
