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
        DB::statement("CREATE OR ALTER VIEW dbo.th_icd10_pasien_gabung_lanjut_v
AS
SELECT     dbo.th_icd10_pasien_gabung_v.no_mr, dbo.th_icd10_pasien_gabung_v.tgl_jam, dbo.th_icd10_pasien_gabung_v.kode_bagian, dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian, 
                      dbo.th_icd10_pasien_gabung_v.diagnosa, dbo.th_icd10_pasien_gabung_v.no_registrasi, dbo.th_icd10_pasien_gabung_v.no_kunjungan, dbo.th_icd10_pasien_gabung_v.status_system
FROM         dbo.th_icd10_pasien_gabung_v INNER JOIN
                      dbo.mt_master_pasien ON dbo.th_icd10_pasien_gabung_v.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.th_icd10_pasien_gabung_v.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.th_icd10_pasien_gabung_v.no_mr, dbo.th_icd10_pasien_gabung_v.tgl_jam, dbo.th_icd10_pasien_gabung_v.kode_bagian, dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian,
                       dbo.th_icd10_pasien_gabung_v.diagnosa, dbo.th_icd10_pasien_gabung_v.no_registrasi, dbo.th_icd10_pasien_gabung_v.no_kunjungan, dbo.th_icd10_pasien_gabung_v.status_system
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_icd10_pasien_gabung_lanjut_v]");
    }
};
