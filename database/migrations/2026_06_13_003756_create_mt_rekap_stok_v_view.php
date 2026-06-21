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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_rekap_stok_v
AS
SELECT     kode_rekap_stok, kode_brg, jml_sat_kcl, stok_minimum, stok_maksimum, harga_beli, harga_persediaan, kode_bagian_gudang
FROM         dbo.mt_rekap_stok
WHERE     (kode_bagian_gudang = '060101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_rekap_stok_v]");
    }
};
