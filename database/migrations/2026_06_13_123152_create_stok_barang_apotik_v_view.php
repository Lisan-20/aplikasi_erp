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
        DB::statement("CREATE VIEW dbo.stok_barang_apotik_v
AS
SELECT     TOP (100) PERCENT dbo.mt_barang.nama_brg, dbo.mt_depo_stok.kode_brg, dbo.mt_depo_stok.kode_bagian, dbo.mt_barang.harga_satuan, dbo.mt_depo_stok.jml_sat_kcl, 
                      dbo.mt_barang.status_aktif, dbo.mt_barang.satuan_kecil
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
WHERE     (dbo.mt_depo_stok.kode_bagian = '060101') AND (dbo.mt_barang.status_aktif = 0)
ORDER BY dbo.mt_barang.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [stok_barang_apotik_v]");
    }
};
