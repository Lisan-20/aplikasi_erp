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
        DB::statement("CREATE VIEW dbo.hasil_so_v
AS
SELECT     TOP (100) PERCENT dbo.tbl_detail_so.kode_brg, dbo.tbl_detail_so.satuan_kecil, dbo.tbl_detail_so.satuan_besar, dbo.tbl_detail_so.so, 
                      dbo.tbl_detail_so.kode_bagian, dbo.tbl_detail_so.harga_satuan, dbo.tbl_detail_so.so * dbo.tbl_detail_so.harga_satuan AS harga, dbo.mt_barang.nama_brg
FROM         dbo.tbl_detail_so INNER JOIN
                      dbo.mt_barang ON dbo.tbl_detail_so.kode_brg = dbo.mt_barang.kode_brg
GROUP BY dbo.tbl_detail_so.kode_brg, dbo.tbl_detail_so.satuan_kecil, dbo.tbl_detail_so.satuan_besar, dbo.tbl_detail_so.so, dbo.tbl_detail_so.kode_bagian, 
                      dbo.tbl_detail_so.harga_satuan, dbo.mt_barang.nama_brg
HAVING      (dbo.tbl_detail_so.so > 0) AND (dbo.tbl_detail_so.harga_satuan > 0)
ORDER BY dbo.tbl_detail_so.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hasil_so_v]");
    }
};
