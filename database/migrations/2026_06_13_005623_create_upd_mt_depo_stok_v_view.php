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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_mt_depo_stok_v
AS
SELECT     TOP (100) PERCENT dbo.mt_depo_stok_brg_jasa.kode_brg, dbo.mt_barang_jasa.nama_brg, dbo.mt_depo_stok_brg_jasa.stok_minimum, dbo.mt_depo_stok_brg_jasa.stok_maksimum, 
                      dbo.mt_depo_stok_brg_jasa.jml_sat_kcl, dbo.mt_barang_jasa.satuan_kecil, dbo.mt_barang_jasa.[content], dbo.mt_barang_jasa.satuan_besar, 
                      dbo.mt_depo_stok_brg_jasa.kode_bagian, dbo.mt_depo_stok_brg_jasa.kode_depo_stok, dbo.mt_barang_jasa.kode_kategori
FROM         dbo.mt_depo_stok_brg_jasa INNER JOIN
                      dbo.mt_barang_jasa ON dbo.mt_depo_stok_brg_jasa.kode_brg = dbo.mt_barang_jasa.kode_brg
WHERE     (dbo.mt_depo_stok_brg_jasa.kode_brg LIKE 'K01%') AND (dbo.mt_depo_stok_brg_jasa.kode_bagian = '070101')
ORDER BY dbo.mt_barang_jasa.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_mt_depo_stok_v]");
    }
};
