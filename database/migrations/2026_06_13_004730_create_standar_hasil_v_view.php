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
        DB::statement("CREATE OR ALTER VIEW dbo.standar_hasil_v
AS
SELECT     TOP (100) PERCENT dbo.tarif_level_4_v.nama_tarif AS nama_kategori, dbo.mt_master_tarif.nama_tarif, dbo.pm_mt_standarhasil.nama_pemeriksaan, 
                      dbo.pm_mt_standarhasil.standar_hasil_wanita, dbo.pm_mt_standarhasil.standar_hasil_pria, dbo.pm_mt_standarhasil.satuan
FROM         dbo.pm_mt_standarhasil INNER JOIN
                      dbo.mt_master_tarif ON dbo.pm_mt_standarhasil.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.tarif_level_4_v ON dbo.mt_master_tarif.referensi = dbo.tarif_level_4_v.kode_tarif INNER JOIN
                      dbo.mt_bagian ON dbo.mt_master_tarif.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.pm_mt_standarhasil.kode_bagian = '050201')
ORDER BY dbo.pm_mt_standarhasil.kode_bagian, nama_kategori, dbo.mt_master_tarif.nama_tarif, dbo.pm_mt_standarhasil.nama_pemeriksaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [standar_hasil_v]");
    }
};
