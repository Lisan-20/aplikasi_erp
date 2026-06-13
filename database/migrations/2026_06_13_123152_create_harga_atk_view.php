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
        DB::statement("CREATE VIEW dbo.harga_atk
AS
SELECT     dbo.mt_barang_nm.nama_brg, dbo.mt_rekap_stok_nm.harga_beli AS harga, dbo.mt_barang_nm.kode_kategori
FROM         dbo.mt_barang_nm INNER JOIN
                      dbo.mt_rekap_stok_nm ON dbo.mt_barang_nm.kode_brg = dbo.mt_rekap_stok_nm.kode_brg
WHERE     (dbo.mt_barang_nm.kode_kategori = 'f')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [harga_atk]");
    }
};
