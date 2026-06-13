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
        DB::statement("
CREATE OR ALTER VIEW dbo.icd10_v
AS
SELECT     dbo.th_icd10_pasien.kode_icd_pasien, dbo.th_icd10_pasien.tgl_jam, dbo.th_icd10_pasien.kode_icd, dbo.th_icd10_pasien.kode_asterik, 
                      dbo.th_icd10_pasien.no_mr, dbo.th_icd10_pasien.group_depkes, dbo.th_icd10_pasien.kode_bagian, dbo.th_icd10_pasien.diagnosa, 
                      dbo.th_icd10_pasien.gender, dbo.th_icd10_pasien.status_hidup, dbo.th_icd10_pasien.jns_penyakit, dbo.mt_master_icd10.kd_asteric, 
                      dbo.mt_master_icd10.kel, dbo.mt_master_icd10.no_urut_dtd, dbo.mt_master_icd10.nama_icd, dbo.mt_master_icd10.group_id, 
                      dbo.mt_master_icd10.icd_rl, dbo.th_icd10_pasien.no_registrasi, dbo.th_icd10_pasien.kode_dokter, dbo.th_icd10_pasien.tipe_rl, 
                      dbo.th_icd10_pasien.status_itung, dbo.th_icd10_pasien.umur, dbo.mt_master_icd10.icd_10
FROM         dbo.th_icd10_pasien INNER JOIN
                      dbo.mt_master_icd10 ON dbo.th_icd10_pasien.kode_icd = dbo.mt_master_icd10.icd_10

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [icd10_v]");
    }
};
