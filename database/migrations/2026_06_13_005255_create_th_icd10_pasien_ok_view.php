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
        DB::statement("CREATE OR ALTER VIEW dbo.th_icd10_pasien_ok
AS
SELECT     dbo.th_icd10_pasien.tgl_jam AS tgl_periksa, dbo.th_icd10_pasien.kode_icd, dbo.th_riwayat_pasien.diagnosa_akhir AS diagnosa, dbo.th_riwayat_pasien.no_registrasi, 
                      dbo.th_riwayat_pasien.no_kunjungan, dbo.th_riwayat_pasien.tgl_periksa AS tgl_jam, dbo.th_riwayat_pasien.no_mr, dbo.th_riwayat_pasien.kode_bagian
FROM         dbo.th_icd10_pasien RIGHT OUTER JOIN
                      dbo.th_riwayat_pasien ON dbo.th_icd10_pasien.no_registrasi = dbo.th_riwayat_pasien.no_registrasi AND dbo.th_icd10_pasien.kode_bagian = dbo.th_riwayat_pasien.kode_bagian AND 
                      dbo.th_icd10_pasien.no_kunjungan = dbo.th_riwayat_pasien.no_kunjungan
GROUP BY dbo.th_icd10_pasien.tgl_jam, dbo.th_icd10_pasien.kode_icd, dbo.th_riwayat_pasien.diagnosa_akhir, dbo.th_riwayat_pasien.no_registrasi, dbo.th_riwayat_pasien.no_kunjungan, 
                      dbo.th_riwayat_pasien.tgl_periksa, dbo.th_riwayat_pasien.no_mr, dbo.th_riwayat_pasien.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_icd10_pasien_ok]");
    }
};
