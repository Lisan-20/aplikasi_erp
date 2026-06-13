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
        DB::statement("CREATE VIEW dbo.obat_tidak_laku_v
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.status_aktif, SUM(dbo.mt_depo_stok.jml_sat_kcl) AS sisa_stok, dbo.mt_barang.satuan_kecil, 
                      dbo.mt_depo_stok.kode_bagian
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
GROUP BY dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.status_aktif, dbo.mt_barang.satuan_kecil, dbo.mt_depo_stok.kode_bagian
HAVING      (dbo.mt_barang.status_aktif IS NULL) OR
                      (dbo.mt_barang.status_aktif = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_tidak_laku_v]");
    }
};
