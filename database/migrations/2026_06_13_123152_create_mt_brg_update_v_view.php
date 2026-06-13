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
        DB::statement("CREATE VIEW dbo.mt_brg_update_v
AS
SELECT     dbo.mt_rekap_stok.harga_beli, dbo.mt_rekap_stok.harga_persediaan, dbo.mt_rekap_stok.harga_beli_ppn, dbo.mt_rekap_stok.harga_beli_non_ppn, dbo.mt_barang.harga_satuan, 
                      CAST(dbo.mt_brg_update.[HARGA SATUAN KECIL] AS int) AS harga_real, dbo.mt_barang.nama_brg
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mt_barang.kode_brg = dbo.mt_rekap_stok.kode_brg INNER JOIN
                      dbo.mt_brg_update ON dbo.mt_barang.nama_brg = dbo.mt_brg_update.[NAMA OBAT]
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_brg_update_v]");
    }
};
