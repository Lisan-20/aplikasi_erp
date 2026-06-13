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
        DB::statement("CREATE OR ALTER VIEW dbo.principal_kurang_coba_v
AS
SELECT     TOP (100) PERCENT dbo.mt_barang.kode_brg, dbo.mt_barang.id_pabrik, dbo.mt_pabrik.nama_pabrik, SUM(dbo.mt_depo_stok.jml_sat_kcl) AS jml_sat_kcl, 
                      SUM(dbo.mt_depo_stok.stok_minimum) AS stok_minimum, dbo.mt_barang.nama_brg
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_pabrik ON dbo.mt_barang.id_pabrik = dbo.mt_pabrik.id_pabrik INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
GROUP BY dbo.mt_barang.kode_brg, dbo.mt_barang.id_pabrik, dbo.mt_pabrik.nama_pabrik, dbo.mt_barang.nama_brg
HAVING      (dbo.mt_barang.id_pabrik = 23)
ORDER BY dbo.mt_barang.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [principal_kurang_coba_v]");
    }
};
