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
        DB::statement("CREATE VIEW dbo.upd_harga_film_rad_v
AS
SELECT     dbo.pm_tc_obalkes.kode_penunjang, dbo.pm_tc_obalkes.kode_brg, dbo.pm_tc_obalkes.kode_tarif, dbo.pm_tc_obalkes.volume, dbo.pm_tc_obalkes.kode_bagian, 
                      dbo.pm_tc_obalkes.harga_jual, dbo.mt_rekap_stok.harga_beli AS harga_beli_rekap, dbo.pm_tc_obalkes.harga_beli
FROM         dbo.pm_tc_obalkes INNER JOIN
                      dbo.mt_rekap_stok ON dbo.pm_tc_obalkes.kode_brg = dbo.mt_rekap_stok.kode_brg
WHERE     (dbo.pm_tc_obalkes.kode_bagian = '050201') AND (dbo.pm_tc_obalkes.harga_beli IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_harga_film_rad_v]");
    }
};
