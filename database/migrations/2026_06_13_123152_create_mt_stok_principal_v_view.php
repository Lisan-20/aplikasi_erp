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
        DB::statement("CREATE VIEW dbo.mt_stok_principal_v
AS
SELECT     dbo.mt_barang.nama_brg, CAST(dbo.mt_depo_stok.stok_minimum AS int) AS stok_minimum, CAST(dbo.mt_depo_stok.stok_maksimum AS int) AS stok_maksimum, dbo.mt_depo_stok.jml_sat_kcl, 
                      dbo.mt_barang.satuan_besar, dbo.mt_barang.satuan_kecil, dbo.mt_barang.id_pabrik, dbo.mt_barang.[content], dbo.mt_pabrik.nama_pabrik, dbo.mt_depo_stok.kode_brg, dbo.mt_barang.flag_medis, 
                      dbo.mt_depo_stok.kode_bagian
FROM         dbo.mt_barang INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg INNER JOIN
                      dbo.mt_pabrik ON dbo.mt_barang.id_pabrik = dbo.mt_pabrik.id_pabrik
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_stok_principal_v]");
    }
};
