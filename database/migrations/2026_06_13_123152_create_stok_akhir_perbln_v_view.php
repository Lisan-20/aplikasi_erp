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
        DB::statement("CREATE OR ALTER VIEW dbo.stok_akhir_perbln_v
AS
SELECT     TOP (100) PERCENT a.kode_brg, a.stok_sekarang, d.nama_brg, MONTH(a.tgl_stok_opname) AS bln, YEAR(a.tgl_stok_opname) AS thn, dbo.cek_max_SO_v.nama_bagian, a.tgl_stok_opname, 
                      a.harga_beli, dbo.cek_max_SO_v.kode_bagian
FROM         dbo.tc_stok_opname AS a INNER JOIN
                      dbo.mt_barang AS d ON a.kode_brg = d.kode_brg INNER JOIN
                      dbo.cek_max_SO_v ON a.id_tc_stok_opname = dbo.cek_max_SO_v.id_tc_stok_opname AND a.kode_bagian = dbo.cek_max_SO_v.kode_bagian
GROUP BY a.kode_bagian, a.kode_brg, a.stok_sekarang, d.nama_brg, MONTH(a.tgl_stok_opname), YEAR(a.tgl_stok_opname), dbo.cek_max_SO_v.nama_bagian, a.tgl_stok_opname, a.harga_beli, 
                      dbo.cek_max_SO_v.kode_bagian
ORDER BY d.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [stok_akhir_perbln_v]");
    }
};
