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
        DB::statement("CREATE OR ALTER VIEW dbo.Gicu_update_11_v
AS
SELECT     dbo.Gicu_1_v.Nomor, dbo.Gicu_1_v.no_registrasi, dbo.tc_pemeriksaan_ews_det.hasil, dbo.tc_pemeriksaan_ews_det.kd_EWS_lev3, dbo.th_gicu_icu.no_registrasi AS no_registrasi_up, 
                      dbo.th_gicu_icu.part11, dbo.tc_pemeriksaan_ews_det.kode_pemeriksaan AS kode_pemeriksaan_det, dbo.th_gicu_icu.kode_pemeriksaan_det AS kode_pemeriksaan_det2
FROM         dbo.tc_pemeriksaan_ews_det INNER JOIN
                      dbo.Gicu_1_v ON dbo.tc_pemeriksaan_ews_det.no_urut_ews = dbo.Gicu_1_v.no_urut_ews AND dbo.tc_pemeriksaan_ews_det.no_registrasi = dbo.Gicu_1_v.no_registrasi INNER JOIN
                      dbo.th_gicu_icu ON dbo.tc_pemeriksaan_ews_det.kd_EWS_lev3 = dbo.th_gicu_icu.kode_pemeriksaan
WHERE     (dbo.Gicu_1_v.Nomor = 11)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [Gicu_update_11_v]");
    }
};
