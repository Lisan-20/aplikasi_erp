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
        DB::statement("CREATE VIEW dbo.pm_cek_hasil_v
AS
SELECT     TOP 100 PERCENT dbo.pm_mt_standarhasil.kode_mt_hasilpm, dbo.pm_mt_standarhasil.kode_tarif, dbo.mt_master_tarif.nama_tarif, 
                      dbo.pm_mt_standarhasil.nama_pemeriksaan, dbo.pm_mt_standarhasil.kode_bagian, dbo.pm_mt_standarhasil.standar_hasil_wanita, 
                      dbo.pm_mt_standarhasil.standar_hasil_pria, dbo.pm_mt_standarhasil.satuan
FROM         dbo.mt_master_tarif LEFT OUTER JOIN
                      dbo.pm_mt_standarhasil ON dbo.mt_master_tarif.kode_tarif = dbo.pm_mt_standarhasil.kode_tarif
WHERE     (dbo.pm_mt_standarhasil.kode_bagian = N'050101')
ORDER BY dbo.pm_mt_standarhasil.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_cek_hasil_v]");
    }
};
