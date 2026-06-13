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
        DB::statement("CREATE VIEW dbo.principal_kurang_v
AS
SELECT     TOP (100) PERCENT COUNT(DISTINCT dbo.mt_depo_stok.kode_brg) AS kode_brg, dbo.mt_barang.id_pabrik, dbo.mt_pabrik.nama_pabrik
FROM         dbo.mt_depo_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg INNER JOIN
                      dbo.mt_pabrik ON dbo.mt_pabrik.id_pabrik = dbo.mt_barang.id_pabrik
WHERE     (dbo.mt_depo_stok.jml_sat_kcl < dbo.mt_depo_stok.stok_minimum)
GROUP BY dbo.mt_barang.id_pabrik, dbo.mt_pabrik.nama_pabrik
ORDER BY dbo.mt_pabrik.nama_pabrik
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [principal_kurang_v]");
    }
};
