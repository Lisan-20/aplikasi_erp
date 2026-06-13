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
        DB::statement("CREATE VIEW dbo.mt_depo_stok_kurang_v
AS
SELECT     dbo.mt_depo_stok.kode_brg, dbo.mt_barang.nama_brg, SUM(dbo.mt_depo_stok.stok_minimum) AS stok_minimum, SUM(dbo.mt_depo_stok.stok_maksimum) AS stok_maksimum, 
                      SUM(dbo.mt_depo_stok.jml_sat_kcl) AS jml_sat_kcl, dbo.mt_barang.satuan_kecil, dbo.mt_barang.[content], dbo.mt_barang.satuan_besar, dbo.mt_depo_stok.kode_bagian, 
                      dbo.mt_barang.flag_medis
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
GROUP BY dbo.mt_depo_stok.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.mt_barang.[content], dbo.mt_barang.satuan_besar, dbo.mt_depo_stok.kode_bagian, 
                      dbo.mt_barang.flag_medis
HAVING      (dbo.mt_barang.[content] > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_depo_stok_kurang_v]");
    }
};
