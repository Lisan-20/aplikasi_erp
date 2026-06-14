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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_standar_hasil_v
AS
SELECT     dbo.pm_mt_standarhasil.kode_mt_hasilpm, dbo.pm_mt_standarhasil.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.pm_mt_standarhasil.nama_pemeriksaan, 
                      dbo.pm_mt_standarhasil.kode_bagian, dbo.pm_mt_standarhasil.standar_hasil_wanita, dbo.pm_mt_standarhasil.standar_hasil_pria, dbo.pm_mt_standarhasil.satuan, 
                      dbo.pm_mt_standarhasil.urutan, dbo.pm_mt_standarhasil.shw_min, dbo.pm_mt_standarhasil.shw_max, dbo.pm_mt_standarhasil.shp_min, dbo.pm_mt_standarhasil.shp_max, 
                      dbo.pm_mt_standarhasil.flag_std_hasil
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.pm_mt_standarhasil ON dbo.mt_master_tarif.kode_tarif = dbo.pm_mt_standarhasil.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_standar_hasil_v]");
    }
};
