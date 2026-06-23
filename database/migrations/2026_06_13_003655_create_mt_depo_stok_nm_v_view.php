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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_depo_stok_brg_jasa_v
AS
SELECT     dbo.mt_depo_stok_brg_jasa.kode_brg, dbo.mt_barang_jasa.nama_brg, SUM(dbo.mt_depo_stok_brg_jasa.stok_minimum) AS stok_minimum, SUM(dbo.mt_depo_stok_brg_jasa.stok_maksimum) AS stok_maksimum, 
                      SUM(dbo.mt_depo_stok_brg_jasa.jml_sat_kcl) AS jml_sat_kcl, dbo.mt_barang_jasa.satuan_kecil, dbo.mt_barang_jasa.[content], dbo.mt_barang_jasa.satuan_besar, dbo.mt_depo_stok_brg_jasa.kode_bagian, 
                      dbo.mt_barang_jasa.kode_kategori, dbo.mt_barang_jasa.flag_asset, dbo.mt_depo_stok_brg_jasa.kode_depo_stok, dbo.mt_depo_stok_brg_jasa.kode_rekap_stok
FROM         dbo.mt_depo_stok_brg_jasa INNER JOIN
                      dbo.mt_barang_jasa ON dbo.mt_depo_stok_brg_jasa.kode_brg = dbo.mt_barang_jasa.kode_brg
GROUP BY dbo.mt_depo_stok_brg_jasa.kode_brg, dbo.mt_barang_jasa.nama_brg, dbo.mt_barang_jasa.satuan_kecil, dbo.mt_barang_jasa.[content], dbo.mt_barang_jasa.satuan_besar, 
                      dbo.mt_depo_stok_brg_jasa.kode_bagian, dbo.mt_barang_jasa.kode_kategori, dbo.mt_barang_jasa.flag_asset, dbo.mt_depo_stok_brg_jasa.kode_depo_stok, dbo.mt_depo_stok_brg_jasa.kode_rekap_stok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_depo_stok_brg_jasa_v]");
    }
};
