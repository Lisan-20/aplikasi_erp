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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_barang_asset_v
AS
SELECT     dbo.mt_barang_jasa.kode_brg, dbo.mt_barang_jasa.nama_brg, dbo.mt_barang_jasa.satuan_besar, dbo.mt_barang_jasa.satuan_kecil, dbo.mt_barang_jasa.kode_pabrik, 
                      dbo.mt_barang_jasa.kode_generik, dbo.mt_barang_jasa.kode_kategori, dbo.mt_barang_jasa.kode_golongan, dbo.mt_barang_jasa.[content], 
                      dbo.mt_rekap_stok_nm.harga_beli, dbo.tc_depo_stok_asset.kode_depo_stok_asset, dbo.tc_depo_stok_asset.jml_sat_kcl_old, dbo.tc_depo_stok_asset.kode_bagian, 
                      dbo.tc_depo_stok_asset.kode_rekap_stok, dbo.tc_depo_stok_asset.id_kartu, dbo.tc_depo_stok_asset.jml_sat_kcl, dbo.tc_depo_stok_asset.nama_rak, 
                      dbo.tc_depo_stok_asset.tgl_perolehan, dbo.tc_depo_stok_asset.tgl_kadaluarsa, dbo.tc_depo_stok_asset.kode_depo_stok_nm, dbo.mt_barang_jasa.flag_asset
FROM         dbo.mt_barang_jasa INNER JOIN
                      dbo.tc_penerimaan_barang_nm_detail ON dbo.mt_barang_jasa.kode_brg = dbo.tc_penerimaan_barang_nm_detail.kode_brg INNER JOIN
                      dbo.mt_rekap_stok_nm ON dbo.mt_barang_jasa.kode_brg = dbo.mt_rekap_stok_nm.kode_brg INNER JOIN
                      dbo.tc_depo_stok_asset ON dbo.mt_barang_jasa.kode_brg = dbo.tc_depo_stok_asset.kode_brg
WHERE     (dbo.mt_barang_jasa.flag_asset = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_barang_asset_v]");
    }
};
