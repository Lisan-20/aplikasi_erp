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
        DB::statement("CREATE VIEW dbo.obat_hd_man_v
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg
FROM         dbo.mt_barang INNER JOIN
                      dbo.barang_hd ON dbo.mt_barang.nama_brg = dbo.barang_hd.nama_brg
WHERE     (dbo.mt_barang.kode_brg NOT IN
                          (SELECT     kode_brg
                            FROM          dbo.mt_depo_stok
                            WHERE      (kode_bagian = '050401')))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_hd_man_v]");
    }
};
