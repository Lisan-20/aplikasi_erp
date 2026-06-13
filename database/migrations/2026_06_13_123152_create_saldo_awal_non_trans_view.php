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
        DB::statement("CREATE VIEW dbo.saldo_awal_non_trans
AS
SELECT     dbo.tbl_detail_so.kode_brg, SUM(dbo.tbl_detail_so.so) AS Expr1, dbo.mt_rekap_stok.harga_beli, dbo.mt_barang.nama_brg
FROM         dbo.tbl_detail_so INNER JOIN
                      dbo.mt_rekap_stok ON dbo.tbl_detail_so.kode_brg = dbo.mt_rekap_stok.kode_brg INNER JOIN
                      dbo.mt_barang ON dbo.tbl_detail_so.kode_brg = dbo.mt_barang.kode_brg LEFT OUTER JOIN
                      dbo.saldo_awal_obat ON dbo.tbl_detail_so.kode_brg = dbo.saldo_awal_obat.kode_brg
WHERE     (dbo.saldo_awal_obat.kode_brg IS NULL)
GROUP BY dbo.tbl_detail_so.kode_brg, dbo.mt_rekap_stok.harga_beli, dbo.mt_barang.nama_brg
HAVING      (SUM(dbo.tbl_detail_so.so) > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [saldo_awal_non_trans]");
    }
};
