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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_barang_gizi_v
AS
SELECT     dbo.mt_barang_jasa.kode_brg, dbo.mt_barang_jasa.nama_brg, dbo.mt_depo_stok_brg_jasa.kode_bagian, dbo.mt_barang_jasa.satuan_kecil, dbo.mt_barang_jasa.satuan_besar, 
                      dbo.mt_barang_jasa.kode_kategori, dbo.mt_barang_jasa.[content], dbo.mt_barang_jasa.harga_beli, dbo.mt_barang_jasa.id_barang
FROM         dbo.mt_barang_jasa INNER JOIN
                      dbo.mt_depo_stok_brg_jasa ON dbo.mt_barang_jasa.kode_brg = dbo.mt_depo_stok_brg_jasa.kode_brg
WHERE     (dbo.mt_depo_stok_brg_jasa.kode_bagian = '050701')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_barang_gizi_v]");
    }
};
