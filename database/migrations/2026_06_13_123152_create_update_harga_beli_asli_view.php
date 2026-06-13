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
        DB::statement("CREATE VIEW dbo.update_harga_beli_asli
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_rekap_stok.harga_beli, dbo.mt_barang.harga_satuan, dbo.mt_harga_beli.hna
FROM         dbo.mt_rekap_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_rekap_stok.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_harga_beli ON dbo.mt_barang.nama_brg = dbo.mt_harga_beli.nama_brg AND dbo.mt_rekap_stok.harga_beli <> dbo.mt_harga_beli.hna
WHERE     (dbo.mt_harga_beli.hna > 10000)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_harga_beli_asli]");
    }
};
