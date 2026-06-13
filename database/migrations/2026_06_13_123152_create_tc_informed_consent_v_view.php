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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_informed_consent_v
AS
SELECT     dbo.tc_informed_consent.id_info, dbo.tc_informed_consent.no_kunjungan, dbo.tc_informed_consent.no_registrasi, dbo.tc_informed_consent.kd_dokter_tind, 
                      dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.tc_informed_consent.pen_info, dbo.tc_informed_consent.nama, dbo.tc_informed_consent.pem_info, dbo.tc_informed_consent.alamat, 
                      dbo.tc_informed_consent.tgl_lahir, dbo.tc_informed_consent.sex, dbo.tc_informed_consent.id_persetujuan, dbo.tc_informed_consent.txt_diagnosis, dbo.tc_informed_consent.txt_dasar_diagnosis, 
                      dbo.tc_informed_consent.txt_tind_dokter, dbo.tc_informed_consent.txt_indikasi, dbo.tc_informed_consent.txt_terapi, dbo.tc_informed_consent.txt_cara, dbo.tc_informed_consent.txt_tujuan, 
                      dbo.tc_informed_consent.txt_resiko, dbo.tc_informed_consent.txt_komplikasi, dbo.tc_informed_consent.txt_alternatif, dbo.tc_informed_consent.txt_rencana, dbo.tc_informed_consent.txt_hal_lain, 
                      dbo.tc_informed_consent.txt_tgl, dbo.tc_informed_consent.saksi1, dbo.tc_informed_consent.saksi2, dbo.tc_informed_consent.no_mr, dbo.tc_informed_consent.tgl_input, 
                      dbo.tc_informed_consent.txt_nama_tindakan, dbo.mt_karyawan.ttd AS ttd_dokter, dbo.tc_informed_consent.ttd_pernyataan, dbo.tc_informed_consent.ttd_saksi1, dbo.tc_informed_consent.ttd_saksi2,
                       dbo.mt_karyawan.no_induk
FROM         dbo.tc_informed_consent LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_informed_consent.kd_dokter_tind = dbo.mt_karyawan.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_informed_consent_v]");
    }
};
