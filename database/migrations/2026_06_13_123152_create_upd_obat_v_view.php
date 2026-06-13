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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_obat_v
AS
SELECT     dbo.mt_rekap_stok.kode_rekap_stok, dbo.mt_rekap_stok.kode_brg, dbo.mt_rekap_stok.jml_sat_kcl, dbo.mt_rekap_stok.stok_minimum, dbo.mt_rekap_stok.stok_maksimum, 
                      dbo.mt_rekap_stok.harga_beli, dbo.mt_rekap_stok.harga_persediaan, dbo.mt_rekap_stok.kode_bagian_gudang, dbo.mt_rekap_stok.harga_beli * 10 / 100 AS ppn, 
                      dbo.mt_rekap_stok.harga_beli + dbo.mt_rekap_stok.harga_beli * 10 / 100 AS harga_beli_ppn_upd, dbo.mt_rekap_stok.harga_beli_ppn, dbo.mt_barang.harga_satuan
FROM         dbo.mt_rekap_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_rekap_stok.kode_brg = dbo.mt_barang.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_obat_v]");
    }
};
