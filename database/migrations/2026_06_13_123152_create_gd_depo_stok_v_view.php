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
        DB::statement("CREATE VIEW dbo.gd_depo_stok_v
AS
SELECT     dbo.mt_barang.nama_brg, dbo.mt_depo_stok.kode_depo_stok, dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_depo_stok.stok_minimum, 
                      dbo.mt_depo_stok.stok_maksimum, dbo.mt_depo_stok.kode_bagian, dbo.mt_depo_stok.kode_rekap_stok, dbo.mt_depo_stok.id_kartu, 
                      dbo.mt_rekap_stok.harga_beli, dbo.mt_barang.kode_brg, dbo.mt_barang.kode_pabrik
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mt_barang.kode_brg = dbo.mt_rekap_stok.kode_brg INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_rekap_stok.kode_rekap_stok = dbo.mt_depo_stok.kode_rekap_stok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [gd_depo_stok_v]");
    }
};
