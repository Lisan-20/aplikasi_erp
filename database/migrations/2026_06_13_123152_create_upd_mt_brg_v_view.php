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
        DB::statement("CREATE VIEW dbo.upd_mt_brg_v
AS
SELECT     TOP (100) PERCENT dbo.upd_mt_barang.st_real, dbo.upd_mt_barang.st_false, dbo.mt_barang.status_aktif, dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg
FROM         dbo.upd_mt_barang INNER JOIN
                      dbo.mt_barang ON dbo.upd_mt_barang.kode_brg = dbo.mt_barang.kode_brg AND dbo.upd_mt_barang.nama_brg = dbo.mt_barang.nama_brg
ORDER BY dbo.mt_barang.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_mt_brg_v]");
    }
};
