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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_depo_stok_nm_v
AS
SELECT     dbo.mt_depo_stok_nm.kode_brg, dbo.mt_barang_nm.nama_brg, SUM(dbo.mt_depo_stok_nm.stok_minimum) AS stok_minimum, SUM(dbo.mt_depo_stok_nm.stok_maksimum) AS stok_maksimum, 
                      SUM(dbo.mt_depo_stok_nm.jml_sat_kcl) AS jml_sat_kcl, dbo.mt_barang_nm.satuan_kecil, dbo.mt_barang_nm.[content], dbo.mt_barang_nm.satuan_besar, dbo.mt_depo_stok_nm.kode_bagian, 
                      dbo.mt_barang_nm.kode_kategori, dbo.mt_barang_nm.flag_asset, dbo.mt_depo_stok_nm.kode_depo_stok, dbo.mt_depo_stok_nm.kode_rekap_stok
FROM         dbo.mt_depo_stok_nm INNER JOIN
                      dbo.mt_barang_nm ON dbo.mt_depo_stok_nm.kode_brg = dbo.mt_barang_nm.kode_brg
GROUP BY dbo.mt_depo_stok_nm.kode_brg, dbo.mt_barang_nm.nama_brg, dbo.mt_barang_nm.satuan_kecil, dbo.mt_barang_nm.[content], dbo.mt_barang_nm.satuan_besar, 
                      dbo.mt_depo_stok_nm.kode_bagian, dbo.mt_barang_nm.kode_kategori, dbo.mt_barang_nm.flag_asset, dbo.mt_depo_stok_nm.kode_depo_stok, dbo.mt_depo_stok_nm.kode_rekap_stok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_depo_stok_nm_v]");
    }
};
