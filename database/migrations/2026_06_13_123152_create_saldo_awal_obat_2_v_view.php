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
        DB::statement("CREATE VIEW dbo.saldo_awal_obat_2_v
AS
SELECT     TOP (100) PERCENT dbo.tbl_detail_so.kode_brg, SUM(dbo.tbl_detail_so.so) AS Expr1, dbo.tbl_detail_so.harga_satuan, SUM(dbo.tbl_detail_so.so) 
                      * dbo.tbl_detail_so.harga_satuan AS TOTAL, dbo.mt_barang.nama_brg, dbo.tbl_detail_so.kode_bagian
FROM         dbo.tbl_detail_so INNER JOIN
                      dbo.mt_barang ON dbo.tbl_detail_so.kode_brg = dbo.mt_barang.kode_brg
GROUP BY dbo.tbl_detail_so.kode_brg, dbo.tbl_detail_so.harga_satuan, dbo.mt_barang.nama_brg, dbo.tbl_detail_so.kode_bagian
HAVING      (SUM(dbo.tbl_detail_so.so) > 0) AND (SUM(dbo.tbl_detail_so.so) * dbo.tbl_detail_so.harga_satuan > 0) AND (dbo.tbl_detail_so.kode_bagian <> '060201')
ORDER BY dbo.mt_barang.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [saldo_awal_obat_2_v]");
    }
};
