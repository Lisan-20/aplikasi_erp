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
        DB::statement("CREATE VIEW dbo.obat_peserta_jkn_v
AS
SELECT     dbo.mt_generik.nama_generik, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.mt_barang.kode_brg, dbo.mt_depo_stok.kode_bagian, dbo.mt_generik.kode_generik, 
                      dbo.mt_barang.harga_satuan
FROM         dbo.mt_depo_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_depo_stok.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_generik ON dbo.mt_barang.kode_generik = dbo.mt_generik.kode_generik
WHERE     (NOT (dbo.mt_generik.nama_generik LIKE '%alkes%')) AND (dbo.mt_depo_stok.kode_bagian = '060101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_peserta_jkn_v]");
    }
};
