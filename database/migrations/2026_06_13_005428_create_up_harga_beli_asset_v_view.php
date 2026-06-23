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
        DB::statement("CREATE OR ALTER VIEW dbo.up_harga_beli_asset_v
AS
SELECT     dbo.mt_barang_asset.kode_brg, dbo.mt_barang_jasa.kode_brg AS Expr1, dbo.mt_barang_asset.harga_beli, dbo.mt_barang_jasa.harga_beli AS harga_beli_up
FROM         dbo.mt_barang_asset INNER JOIN
                      dbo.mt_barang_jasa ON dbo.mt_barang_asset.kode_brg = dbo.mt_barang_jasa.kode_brg
WHERE     (dbo.mt_barang_jasa.harga_beli > 0) AND (dbo.mt_barang_asset.harga_beli IS NULL) OR
                      (dbo.mt_barang_asset.harga_beli = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [up_harga_beli_asset_v]");
    }
};
