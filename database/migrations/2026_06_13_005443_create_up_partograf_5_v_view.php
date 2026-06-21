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
        DB::statement("CREATE OR ALTER VIEW dbo.up_partograf_5_v
AS
SELECT     dbo.partograf_1_v.Nomor, dbo.partograf_1_v.no_registrasi, dbo.tc_pemeriksaan_ews_det.hasil, dbo.tc_pemeriksaan_ews_det.kd_EWS_lev3, dbo.th_partograf.no_registrasi AS no_registrasi_up, 
                      dbo.th_partograf.part5, dbo.partograf_1_v.kode_pemeriksaan AS kode_pemeriksaan_det, dbo.th_partograf.kode_pemeriksaan_det AS kode_pemeriksaan_det2
FROM         dbo.tc_pemeriksaan_ews_det INNER JOIN
                      dbo.partograf_1_v ON dbo.tc_pemeriksaan_ews_det.no_urut_ews = dbo.partograf_1_v.no_urut_ews AND dbo.tc_pemeriksaan_ews_det.no_registrasi = dbo.partograf_1_v.no_registrasi INNER JOIN
                      dbo.th_partograf ON dbo.tc_pemeriksaan_ews_det.kd_EWS_lev3 = dbo.th_partograf.kode_pemeriksaan
WHERE     (dbo.partograf_1_v.Nomor = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [up_partograf_5_v]");
    }
};
