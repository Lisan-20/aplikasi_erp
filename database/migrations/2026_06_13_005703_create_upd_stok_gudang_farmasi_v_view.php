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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_stok_gudang_farmasi_v
AS
SELECT     dbo.depo_stok_farmasi_v.kode_depo_stok, dbo.depo_stok_farmasi_v.kode_brg, dbo.depo_stok_farmasi_v.jml_sat_kcl, dbo.depo_stok_farmasi_v.stok_minimum, 
                      dbo.depo_stok_farmasi_v.stok_maksimum, dbo.depo_stok_farmasi_v.kode_bagian, dbo.depo_stok_farmasi_v.kode_rekap_stok, dbo.depo_stok_farmasi_v.id_kartu, 
                      dbo.depo_stok_gudang_farmasi_v.kode_brg AS Expr1
FROM         dbo.depo_stok_farmasi_v LEFT OUTER JOIN
                      dbo.depo_stok_gudang_farmasi_v ON dbo.depo_stok_farmasi_v.kode_brg = dbo.depo_stok_gudang_farmasi_v.kode_brg
WHERE     (dbo.depo_stok_gudang_farmasi_v.kode_brg IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_stok_gudang_farmasi_v]");
    }
};
