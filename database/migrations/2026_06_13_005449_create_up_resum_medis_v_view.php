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
        DB::statement("CREATE OR ALTER VIEW dbo.up_resum_medis_v
AS
SELECT     dbo.tc_pemeriksaan_resum_medis.kode_pemeriksaan, dbo.tc_pemeriksaan_resum_medis.hasil, dbo.tc_pemeriksaan_resum_medis.kode_rm, dbo.tc_pemeriksaan_resum_medis.no_registrasi, 
                      dbo.tc_emr_form.id_user, dbo.mt_karyawan.kode_dokter, dbo.tc_dpjp_rinap.dr_merawat
FROM         dbo.tc_pemeriksaan_resum_medis INNER JOIN
                      dbo.tc_emr_form ON dbo.tc_pemeriksaan_resum_medis.kode_rm = dbo.tc_emr_form.kode_rm AND dbo.tc_pemeriksaan_resum_medis.no_registrasi = dbo.tc_emr_form.no_registrasi INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_emr_form.id_user = dbo.mt_karyawan.no_induk INNER JOIN
                      dbo.tc_dpjp_rinap ON dbo.tc_pemeriksaan_resum_medis.no_registrasi = dbo.tc_dpjp_rinap.no_registrasi
WHERE     (dbo.tc_pemeriksaan_resum_medis.kode_pemeriksaan = N'56100') AND (dbo.tc_pemeriksaan_resum_medis.hasil IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [up_resum_medis_v]");
    }
};
