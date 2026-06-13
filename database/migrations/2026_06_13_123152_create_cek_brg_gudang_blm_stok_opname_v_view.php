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
        DB::statement("CREATE VIEW dbo.cek_brg_gudang_blm_stok_opname_v
AS
SELECT     dbo.mt_depo_stok.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_depo_stok.kode_bagian
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
WHERE     (dbo.mt_depo_stok.kode_bagian = '060201') AND (dbo.mt_barang.kode_brg NOT IN
                          (SELECT     kode_brg
                            FROM          dbo.cek_stok_opname_gudang_v)) AND (dbo.mt_depo_stok.jml_sat_kcl > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_brg_gudang_blm_stok_opname_v]");
    }
};
