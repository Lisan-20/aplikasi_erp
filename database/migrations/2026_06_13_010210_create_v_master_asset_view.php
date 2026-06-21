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
        DB::statement("CREATE OR ALTER VIEW dbo.v_master_asset
AS
SELECT     dbo.mt_barang_asset.kode_brg, dbo.mt_barang_asset.nama_brg, dbo.mt_barang_asset.harga_beli, dbo.mt_barang_asset.tgl_beli, dbo.mt_barang_asset.tahun_beli, 
                      dbo.tc_depo_stok_asset.kode_bagian, dbo.tc_depo_stok_asset.jumlah, dbo.tc_depo_stok_asset.tgl_perolehan, dbo.tc_depo_stok_asset.tgl_kadaluarsa, dbo.mt_barang_asset.satuan_kecil
FROM         dbo.mt_barang_asset INNER JOIN
                      dbo.tc_depo_stok_asset ON dbo.mt_barang_asset.kode_brg = dbo.tc_depo_stok_asset.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_master_asset]");
    }
};
