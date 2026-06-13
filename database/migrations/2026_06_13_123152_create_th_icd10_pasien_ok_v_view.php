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
        DB::statement("CREATE VIEW dbo.th_icd10_pasien_ok_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.jen_kelamin AS gender, dbo.th_icd10_pasien.kode_icd_pasien, CASE WHEN tgl_jam IS NULL 
                      THEN th_icd10_pasien.tgl_input ELSE tgl_jam END AS tgl_jam, dbo.th_icd10_pasien.kode_icd, dbo.th_icd10_pasien.kode_asterik, dbo.th_icd10_pasien.no_mr, dbo.th_icd10_pasien.group_depkes, 
                      dbo.th_icd10_pasien.no_registrasi, dbo.th_icd10_pasien.kode_bagian, dbo.th_icd10_pasien.kode_dokter, dbo.th_icd10_pasien.diagnosa, dbo.th_icd10_pasien.tipe_rl, 
                      dbo.th_icd10_pasien.status_itung, dbo.th_icd10_pasien.umur, dbo.th_icd10_pasien.status_hidup, dbo.th_icd10_pasien.jns_penyakit, dbo.th_icd10_pasien.user_id, DATEDIFF(DAY, 
                      dbo.mt_master_pasien.tgl_lhr, dbo.th_icd10_pasien.tgl_jam) AS hari, dbo.tc_registrasi.tgl_jam_masuk AS tgl_input
FROM         dbo.th_icd10_pasien INNER JOIN
                      dbo.mt_master_pasien ON dbo.th_icd10_pasien.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.th_icd10_pasien.no_registrasi = dbo.tc_registrasi.no_registrasi
ORDER BY hari
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_icd10_pasien_ok_v]");
    }
};
