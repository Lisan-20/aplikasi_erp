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
        DB::statement("CREATE VIEW dbo.stock_amprah_seluruh_v
AS
SELECT     dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.mt_bagian.nama_bagian, dbo.mt_barang.kode_brg, dbo.mt_depo_stok.jml_sat_kcl, 
                      dbo.mt_depo_stok.stok_minimum, dbo.mt_depo_stok.kode_bagian, 0 AS jumlah
FROM         dbo.mt_depo_stok INNER JOIN
                      dbo.mt_bagian ON dbo.mt_depo_stok.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_barang ON dbo.mt_depo_stok.kode_brg = dbo.mt_barang.kode_brg
GROUP BY dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.mt_bagian.nama_bagian, dbo.mt_barang.kode_brg, dbo.mt_depo_stok.jml_sat_kcl, 
                      dbo.mt_depo_stok.stok_minimum, dbo.mt_depo_stok.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [stock_amprah_seluruh_v]");
    }
};
