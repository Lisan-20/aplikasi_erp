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
        DB::statement("CREATE VIEW dbo.bhn_stok_opname_v
AS
SELECT     TOP (100) PERCENT dbo.mt_depo_stok.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.mt_barang.satuan_besar, 
                      dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_bagian.nama_bagian
FROM         dbo.mt_depo_stok INNER JOIN
                      dbo.mt_bagian ON dbo.mt_depo_stok.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_barang ON dbo.mt_depo_stok.kode_brg = dbo.mt_barang.kode_brg
ORDER BY dbo.mt_depo_stok.kode_bagian, dbo.mt_barang.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bhn_stok_opname_v]");
    }
};
