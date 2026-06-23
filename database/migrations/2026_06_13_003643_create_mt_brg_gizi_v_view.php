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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_brg_gizi_v
AS
SELECT     dbo.mt_barang_jasa.nama_brg, dbo.mt_barang_jasa.kode_brg, dbo.mt_barang_jasa.kode_golongan, dbo.mt_golongan_nm.nama_golongan, 
                      dbo.mt_barang_jasa.kode_sub_golongan, dbo.mt_sub_golongan_nm.nama_sub_golongan, dbo.mt_barang_jasa.satuan_besar, dbo.mt_barang_jasa.satuan_kecil, 
                      dbo.mt_barang_jasa.[content]
FROM         dbo.mt_barang_jasa INNER JOIN
                      dbo.mt_golongan_nm ON dbo.mt_barang_jasa.kode_golongan = dbo.mt_golongan_nm.kode_golongan INNER JOIN
                      dbo.mt_sub_golongan_nm ON dbo.mt_barang_jasa.kode_sub_golongan = dbo.mt_sub_golongan_nm.kode_sub_gol
WHERE     (dbo.mt_barang_jasa.kode_kategori = 'L')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_brg_gizi_v]");
    }
};
