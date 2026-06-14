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
        DB::statement("CREATE OR ALTER VIEW dbo.saldo_awal_obat_v
AS
SELECT     TOP (100) PERCENT dbo.tbl_detail_so.kode_brg, dbo.tbl_detail_so.so, dbo.tbl_detail_so.harga_satuan, dbo.tbl_detail_so.kode_bagian, dbo.tc_kartu_stok.pemasukan, 
                      dbo.tc_kartu_stok.pengeluaran, dbo.tc_kartu_stok.tgl_input
FROM         dbo.tc_kartu_stok INNER JOIN
                      dbo.tbl_detail_so ON dbo.tc_kartu_stok.kode_brg = dbo.tbl_detail_so.kode_brg AND dbo.tc_kartu_stok.kode_bagian = dbo.tbl_detail_so.kode_bagian
WHERE     (dbo.tc_kartu_stok.tgl_input BETWEEN dbo.tbl_detail_so.tgl_input AND '2013-12-31 23:23:59')
ORDER BY dbo.tbl_detail_so.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [saldo_awal_obat_v]");
    }
};
