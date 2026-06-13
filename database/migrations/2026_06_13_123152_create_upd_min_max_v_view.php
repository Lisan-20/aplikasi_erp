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
        DB::statement("CREATE VIEW dbo.upd_min_max_v
AS
SELECT     dbo.mt_barang.nama_brg, dbo.mt_depo_stok.kode_bagian, dbo.upd_min_max.[stok minimal], dbo.upd_min_max.[stok maksimal], dbo.mt_depo_stok.stok_minimum, 
                      dbo.mt_depo_stok.stok_maksimum, dbo.upd_min_max.No#
FROM         dbo.mt_depo_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_depo_stok.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.upd_min_max ON dbo.mt_barang.nama_brg = dbo.upd_min_max.[Nama Barang]
WHERE     (dbo.mt_depo_stok.kode_bagian = '060101') AND (dbo.upd_min_max.No# <> N'0.0')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_min_max_v]");
    }
};
