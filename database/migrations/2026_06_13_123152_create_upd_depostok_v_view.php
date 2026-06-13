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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_depostok_v
AS
SELECT     dbo.upd_depoobat.kode_depo_stok, dbo.upd_depoobat.kode_brg, dbo.upd_depoobat.jml_sat_kcl_old, dbo.upd_depoobat.stok_minimum, 
                      dbo.upd_depoobat.stok_maksimum, dbo.upd_depoobat.kode_bagian, dbo.upd_depoobat.kode_rekap_stok AS real1, dbo.mt_rekap_stok.kode_rekap_stok AS real2, 
                      dbo.upd_depoobat.id_kartu, dbo.upd_depoobat.jml_sat_kcl, dbo.upd_depoobat.nama_rak, dbo.upd_depoobat.status
FROM         dbo.mt_rekap_stok INNER JOIN
                      dbo.upd_depoobat ON dbo.mt_rekap_stok.kode_brg = dbo.upd_depoobat.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_depostok_v]");
    }
};
