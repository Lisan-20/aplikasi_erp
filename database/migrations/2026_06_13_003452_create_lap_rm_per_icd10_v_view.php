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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rm_per_icd10_v
AS
SELECT     MONTH(dbo.th_icd10_pasien.tgl_input) AS bulan, YEAR(dbo.th_icd10_pasien.tgl_input) AS tahun, dbo.th_icd10_pasien.kode_icd, dbo.th_icd10_pasien.tipe_rl, 
                      SUBSTRING(dbo.th_icd10_pasien.kode_bagian, 1, 2) AS kobag, dbo.th_icd10_pasien.kode_bagian, dbo.mt_grup_icd_10.nama_icd_10, dbo.th_icd10_pasien.no_registrasi, 
                      dbo.th_icd10_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian, dbo.th_icd10_pasien.diagnosa, dbo.th_icd10_pasien.tgl_jam, dbo.mt_master_pasien.pekerjaan, 
                      dbo.mt_master_pasien.kode_agama, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.umur_pasien, dbo.mt_master_pasien.kota, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.kode_kelompok, dbo.th_icd10_pasien.umur, dbo.th_icd10_pasien.tgl_input, dbo.mt_master_pasien.id_dc_kota
FROM         dbo.th_icd10_pasien INNER JOIN
                      dbo.mt_master_pasien ON dbo.th_icd10_pasien.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.th_icd10_pasien.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_grup_icd_10 ON dbo.th_icd10_pasien.kode_icd = dbo.mt_grup_icd_10.kode_icd
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rm_per_icd10_v]");
    }
};
