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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_resume_medis_v
AS
SELECT     dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.tc_resume_medis.no_mr, dbo.tc_resume_medis.diagnosis, dbo.tc_resume_medis.terapi, 
                      dbo.tc_resume_medis.pemeriksaan_fisik, dbo.tc_resume_medis.rencana_pemeriksaan, dbo.tc_resume_medis.kode_bagian_kontrol_old, 
                      dbo.tc_resume_medis.tgl_kontrol, dbo.tc_resume_medis.kode_paramedis, dbo.tc_resume_medis.no_registrasi, dbo.tc_resume_medis.no_kunjungan, 
                      dbo.tc_resume_medis.id_user, dbo.tc_resume_medis.tgl_input, dbo.tc_resume_medis.kode_bagian_kontrol, dbo.mt_master_pasien.jen_kelamin
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_resume_medis ON dbo.mt_master_pasien.no_mr = dbo.tc_resume_medis.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_resume_medis_v]");
    }
};
