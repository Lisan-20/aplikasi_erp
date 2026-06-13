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
        DB::statement("CREATE VIEW dbo.stok_apotik_v
AS
SELECT     dbo.mt_depo_stok.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.mt_barang.harga_satuan, 
                      dbo.mt_rekap_stok.harga_beli, dbo.mt_barang.status_aktif, dbo.mt_barang.barcode
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg INNER JOIN
                      dbo.mt_bagian ON dbo.mt_depo_stok.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mt_barang.kode_brg = dbo.mt_rekap_stok.kode_brg
GROUP BY dbo.mt_depo_stok.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.mt_barang.harga_satuan, 
                      dbo.mt_rekap_stok.harga_beli, dbo.mt_barang.status_aktif, dbo.mt_barang.barcode
HAVING      (dbo.mt_depo_stok.kode_bagian = '060101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [stok_apotik_v]");
    }
};
