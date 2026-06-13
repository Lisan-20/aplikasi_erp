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
        DB::statement("CREATE VIEW dbo.resumdiag_gizi_v
AS
SELECT     dbo.tc_sensus_gizi.id_tc_sensus_gizi, dbo.tc_registrasi.no_mr, dbo.tc_sensus_gizi.diagnosa, dbo.tc_sensus_gizi.diet, 
                      dbo.tc_sensus_gizi.perubahan_diet, dbo.tc_sensus_gizi.keterangan, dbo.tc_sensus_gizi.status_pasien, dbo.mt_master_pasien.nama_pasien, 
                      dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_sensus_gizi.tgl, dbo.tc_sensus_gizi.kode_penunjang, 
                      dbo.tc_sensus_gizi.alergi, dbo.tc_sensus_gizi.kode_icd_diagnosa, dbo.th_riwayat_pasien.tgl_periksa, dbo.th_riwayat_pasien.alergi AS alergiobat, 
                      dbo.th_riwayat_pasien.anamnesa, dbo.th_riwayat_pasien.kode_riwayat, dbo.th_riwayat_pasien.dokter_pemeriksa, 
                      dbo.th_riwayat_pasien.flag_entry
FROM         dbo.tc_sensus_gizi INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_sensus_gizi.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_sensus_gizi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.th_riwayat_pasien ON dbo.tc_registrasi.no_registrasi = dbo.th_riwayat_pasien.no_registrasi
WHERE     (dbo.th_riwayat_pasien.flag_entry = 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [resumdiag_gizi_v]");
    }
};
