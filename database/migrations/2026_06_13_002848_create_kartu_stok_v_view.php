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
        DB::statement("CREATE OR ALTER VIEW dbo.kartu_stok_v
AS
SELECT     dbo.tc_kartu_stok.*, dbo.mt_barang.status_aktif
FROM         dbo.tc_kartu_stok INNER JOIN
                      dbo.mt_barang ON dbo.tc_kartu_stok.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.mt_barang.status_aktif = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kartu_stok_v]");
    }
};
