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
        DB::statement("CREATE VIEW dbo.stok_kurang_apt_gd_v
AS
SELECT     TOP (100) PERCENT dbo.mt_depo_stok_minimum_2_v.kode_brg, dbo.mt_depo_stok_minimum_2_v.nama_brg, SUM(dbo.mt_depo_stok_minimum_2_v.jml_sat_kcl) AS jml_sat_kcl, 
                      dbo.mt_depo_stok_minimum_2_v.satuan_kecil, dbo.mt_depo_stok_v.kode_bagian, dbo.mt_depo_stok_v.stok_minimum
FROM         dbo.mt_depo_stok_minimum_2_v INNER JOIN
                      dbo.mt_depo_stok_v ON dbo.mt_depo_stok_minimum_2_v.kode_brg = dbo.mt_depo_stok_v.kode_brg
WHERE     (dbo.mt_depo_stok_minimum_2_v.kode_bagian IN ('060201', '060101'))
GROUP BY dbo.mt_depo_stok_minimum_2_v.kode_brg, dbo.mt_depo_stok_minimum_2_v.nama_brg, dbo.mt_depo_stok_minimum_2_v.satuan_kecil, dbo.mt_depo_stok_v.kode_bagian, 
                      dbo.mt_depo_stok_v.stok_minimum
HAVING      (dbo.mt_depo_stok_v.kode_bagian = '060201')
ORDER BY dbo.mt_depo_stok_minimum_2_v.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [stok_kurang_apt_gd_v]");
    }
};
