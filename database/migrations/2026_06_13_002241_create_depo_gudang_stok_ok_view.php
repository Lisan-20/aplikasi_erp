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
        DB::statement("CREATE OR ALTER VIEW dbo.depo_gudang_stok_ok
AS
SELECT     dbo.mt_depo_stok.kode_depo_stok, dbo.mt_depo_stok.kode_brg, dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_depo_stok.stok_minimum, 
                      dbo.mt_depo_stok.stok_maksimum, dbo.mt_depo_stok.kode_bagian, dbo.mt_depo_stok.kode_rekap_stok, dbo.mt_depo_stok.id_kartu, dbo.mt_barang.nama_brg
FROM         dbo.mt_depo_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_depo_stok.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.mt_depo_stok.kode_bagian = '060201') AND (dbo.mt_depo_stok.jml_sat_kcl > dbo.mt_depo_stok.stok_minimum)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [depo_gudang_stok_ok]");
    }
};
