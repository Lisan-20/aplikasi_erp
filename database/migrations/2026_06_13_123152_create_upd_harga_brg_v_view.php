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
        DB::statement("CREATE VIEW dbo.upd_harga_brg_v
AS
SELECT     TOP (100) PERCENT dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.harga_satuan, dbo.mt_rekap_stok.harga_beli, dbo.mt_barang.[content], 
                      dbo.mt_barang.user_edit, dbo.mt_barang.tgl_edit, dbo.mt_barang.status_aktif
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mt_barang.kode_brg = dbo.mt_rekap_stok.kode_brg AND dbo.mt_barang.harga_satuan <> dbo.mt_rekap_stok.harga_beli
ORDER BY dbo.mt_barang.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_harga_brg_v]");
    }
};
