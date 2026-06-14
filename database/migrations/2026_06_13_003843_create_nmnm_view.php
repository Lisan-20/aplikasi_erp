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
        DB::statement("CREATE OR ALTER VIEW dbo.nmnm
AS
SELECT     TOP (100) PERCENT dbo.mt_brg_nm_n.Kode_barang, dbo.mt_brg_nm_n.nama_barang, dbo.mt_brg_nm_n.Kategori, dbo.mt_brg_nm_n.golongan, 
                      dbo.mt_brg_nm_n.sub_gol, dbo.mt_barang_nm_old.satuan_besar, dbo.mt_barang_nm_old.satuan_kecil
FROM         dbo.mt_barang_nm_old INNER JOIN
                      dbo.mt_brg_nm_n ON dbo.mt_barang_nm_old.nama_brg = dbo.mt_brg_nm_n.nama_barang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [nmnm]");
    }
};
