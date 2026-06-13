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
        DB::statement("CREATE VIEW dbo.mt_brg_gizi_v
AS
SELECT     dbo.mt_barang_nm.nama_brg, dbo.mt_barang_nm.kode_brg, dbo.mt_barang_nm.kode_golongan, dbo.mt_golongan_nm.nama_golongan, 
                      dbo.mt_barang_nm.kode_sub_golongan, dbo.mt_sub_golongan_nm.nama_sub_golongan, dbo.mt_barang_nm.satuan_besar, dbo.mt_barang_nm.satuan_kecil, 
                      dbo.mt_barang_nm.[content]
FROM         dbo.mt_barang_nm INNER JOIN
                      dbo.mt_golongan_nm ON dbo.mt_barang_nm.kode_golongan = dbo.mt_golongan_nm.kode_golongan INNER JOIN
                      dbo.mt_sub_golongan_nm ON dbo.mt_barang_nm.kode_sub_golongan = dbo.mt_sub_golongan_nm.kode_sub_gol
WHERE     (dbo.mt_barang_nm.kode_kategori = 'L')
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
