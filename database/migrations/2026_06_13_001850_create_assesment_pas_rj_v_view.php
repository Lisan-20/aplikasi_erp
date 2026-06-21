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
        DB::statement("CREATE OR ALTER VIEW dbo.assesment_pas_rj_v
AS
SELECT     dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.kode_agama, 
                      dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.no_registrasi, 
                      dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.tgl_masuk, dbo.mt_master_pasien.pekerjaan, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_master_pasien.status_perkaw, dbo.mt_master_pasien.tlp_almt_lkl, dbo.mt_master_pasien.nama_kel_ter, dbo.mt_master_pasien.nama_almt_kel, 
                      dbo.mt_master_pasien.nama_ayah
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [assesment_pas_rj_v]");
    }
};
