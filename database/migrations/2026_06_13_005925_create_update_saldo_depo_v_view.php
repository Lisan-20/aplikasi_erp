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
        DB::statement("CREATE OR ALTER VIEW dbo.update_saldo_depo_v
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_depo_stok.kode_bagian, dbo.saldo_depo.saldo, dbo.mt_depo_stok.jml_sat_kcl
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg INNER JOIN
                      dbo.saldo_depo ON dbo.mt_barang.nama_brg = dbo.saldo_depo.nama_brg
WHERE     (dbo.mt_depo_stok.kode_bagian = '060101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_saldo_depo_v]");
    }
};
