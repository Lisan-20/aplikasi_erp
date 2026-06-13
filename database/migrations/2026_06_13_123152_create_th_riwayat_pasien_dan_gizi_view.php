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
        DB::statement("CREATE OR ALTER VIEW dbo.th_riwayat_pasien_dan_gizi
AS
SELECT     dbo.th_riwayat_pasien.kode_riwayat, dbo.th_riwayat_pasien.no_registrasi, dbo.th_riwayat_pasien.no_mr, dbo.th_riwayat_pasien.no_kunjungan, 
                      dbo.th_riwayat_pasien.nama_pasien, dbo.th_riwayat_pasien.diagnosa_awal, dbo.th_riwayat_pasien.anamnesa, dbo.th_riwayat_pasien.pengobatan, 
                      dbo.th_riwayat_pasien.dokter_pemeriksa, dbo.th_riwayat_pasien.pemeriksaan, dbo.th_riwayat_pasien.tgl_periksa, 
                      dbo.th_riwayat_pasien.kode_bagian, dbo.th_riwayat_pasien.diagnosa_akhir, dbo.th_riwayat_pasien.kode_icd_diagnosa, 
                      dbo.th_riwayat_pasien.tgl_input, dbo.th_riwayat_pasien.user_id, dbo.th_riwayat_pasien.alergi, dbo.th_riwayat_pasien.kd_dr_pemeriksa, 
                      dbo.th_riwayat_pasien.diagnosa, dbo.th_riwayat_pasien.flag_entry, dbo.th_riwayat_pasien.diagnosa_awal_tambahan, dbo.tc_sensus_gizi.kode_diet, 
                      dbo.tc_sensus_gizi.diet
FROM         dbo.th_riwayat_pasien INNER JOIN
                      dbo.tc_sensus_gizi ON dbo.th_riwayat_pasien.no_registrasi = dbo.tc_sensus_gizi.no_registrasi AND 
                      dbo.th_riwayat_pasien.no_mr = dbo.tc_sensus_gizi.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_riwayat_pasien_dan_gizi]");
    }
};
