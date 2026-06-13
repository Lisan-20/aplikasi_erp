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
        DB::statement("CREATE VIEW dbo.update_harga_lagi_v
AS
SELECT     dbo.upd_harga.isi, dbo.upd_harga.harga_kecil, dbo.upd_harga.sat_kecil, dbo.mt_barang.satuan_kecil, dbo.mt_barang.[content], dbo.mt_barang.harga_satuan, dbo.mt_rekap_stok.harga_beli, 
                      dbo.mt_rekap_stok.harga_persediaan
FROM         dbo.mt_barang INNER JOIN
                      dbo.upd_harga ON dbo.mt_barang.kode_brg = dbo.upd_harga.kode_brg INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mt_barang.kode_brg = dbo.mt_rekap_stok.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_harga_lagi_v]");
    }
};
