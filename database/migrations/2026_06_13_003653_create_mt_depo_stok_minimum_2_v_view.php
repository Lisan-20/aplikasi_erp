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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_depo_stok_minimum_2_v
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_depo_stok.kode_depo_stok, dbo.mt_depo_stok.kode_bagian, dbo.mt_depo_stok.stok_minimum, dbo.mt_depo_stok.stok_maksimum, 
                      dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_depo_stok.kode_rekap_stok, dbo.mt_depo_stok.id_kartu, dbo.mt_barang.kode_pabrik, dbo.mt_barang.kode_generik, dbo.mt_barang.kode_kategori, 
                      dbo.mt_barang.satuan_besar, dbo.mt_barang.satuan_kecil, dbo.mt_barang.flag_medis, dbo.mt_barang.jenis_askes, dbo.mt_barang.kode_sub_golongan, dbo.mt_barang.kode_golongan, 
                      dbo.mt_barang.id_pabrik, dbo.mt_barang.status_aktif
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
WHERE     (dbo.mt_barang.status_aktif IS NULL OR
                      dbo.mt_barang.status_aktif = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_depo_stok_minimum_2_v]");
    }
};
