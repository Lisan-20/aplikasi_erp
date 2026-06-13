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
        DB::statement("CREATE VIEW dbo.mt_barang_gizi_v
AS
SELECT     dbo.mt_barang_nm.kode_brg, dbo.mt_barang_nm.nama_brg, dbo.mt_depo_stok_nm.kode_bagian, dbo.mt_barang_nm.satuan_kecil, dbo.mt_barang_nm.satuan_besar, 
                      dbo.mt_barang_nm.kode_kategori, dbo.mt_barang_nm.[content], dbo.mt_barang_nm.harga_beli, dbo.mt_barang_nm.id_barang
FROM         dbo.mt_barang_nm INNER JOIN
                      dbo.mt_depo_stok_nm ON dbo.mt_barang_nm.kode_brg = dbo.mt_depo_stok_nm.kode_brg
WHERE     (dbo.mt_depo_stok_nm.kode_bagian = '050701')
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
