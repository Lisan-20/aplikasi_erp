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
        DB::statement("CREATE OR ALTER VIEW dbo.update_stok
AS
SELECT     dbo.mt_rekap_stok.kode_brg, dbo.mt_barang.flag_medis, dbo.mt_depo_stok.kode_bagian, dbo.mt_rekap_stok.kode_bagian_gudang
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_rekap_stok ON dbo.mt_barang.kode_brg = dbo.mt_rekap_stok.kode_brg INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
WHERE     (dbo.mt_barang.flag_medis = 1) AND (dbo.mt_depo_stok.kode_bagian = '060301')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_stok]");
    }
};
