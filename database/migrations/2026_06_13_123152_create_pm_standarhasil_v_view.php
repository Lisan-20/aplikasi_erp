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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_standarhasil_v
AS
SELECT     dbo.pm_pemeriksaanpasien_v.kode_trans_pelayanan, dbo.pm_pemeriksaanpasien_v.jenis_tindakan, dbo.pm_pemeriksaanpasien_v.nama_tindakan, 
                      dbo.pm_mt_standarhasil.kode_mt_hasilpm, dbo.pm_mt_standarhasil.nama_pemeriksaan, dbo.pm_mt_standarhasil.kode_bagian, 
                      dbo.pm_mt_standarhasil.standar_hasil_wanita, dbo.pm_mt_standarhasil.standar_hasil_pria, dbo.pm_mt_standarhasil.kode_tarif
FROM         dbo.pm_pemeriksaanpasien_v INNER JOIN
                      dbo.pm_mt_standarhasil ON dbo.pm_pemeriksaanpasien_v.jenis_tindakan = dbo.pm_mt_standarhasil.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_standarhasil_v]");
    }
};
