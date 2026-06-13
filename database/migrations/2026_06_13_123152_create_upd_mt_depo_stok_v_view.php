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
        DB::statement("CREATE VIEW dbo.upd_mt_depo_stok_v
AS
SELECT     TOP (100) PERCENT dbo.mt_depo_stok_nm.kode_brg, dbo.mt_barang_nm.nama_brg, dbo.mt_depo_stok_nm.stok_minimum, dbo.mt_depo_stok_nm.stok_maksimum, 
                      dbo.mt_depo_stok_nm.jml_sat_kcl, dbo.mt_barang_nm.satuan_kecil, dbo.mt_barang_nm.[content], dbo.mt_barang_nm.satuan_besar, 
                      dbo.mt_depo_stok_nm.kode_bagian, dbo.mt_depo_stok_nm.kode_depo_stok, dbo.mt_barang_nm.kode_kategori
FROM         dbo.mt_depo_stok_nm INNER JOIN
                      dbo.mt_barang_nm ON dbo.mt_depo_stok_nm.kode_brg = dbo.mt_barang_nm.kode_brg
WHERE     (dbo.mt_depo_stok_nm.kode_brg LIKE 'K01%') AND (dbo.mt_depo_stok_nm.kode_bagian = '070101')
ORDER BY dbo.mt_barang_nm.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_mt_depo_stok_v]");
    }
};
