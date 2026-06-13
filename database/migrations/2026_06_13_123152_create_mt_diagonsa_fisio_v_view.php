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
        DB::statement("CREATE VIEW dbo.mt_diagonsa_fisio_v
AS
SELECT     dbo.th_riwayat_pasien.no_registrasi, dbo.th_riwayat_pasien.no_mr, dbo.mt_icd_diagnosa.nama_diagnosa, dbo.th_riwayat_pasien.kode_icd_diagnosa, dbo.th_riwayat_pasien.diagnosa, 
                      dbo.mt_nasabah.nama_kelompok, dbo.th_riwayat_pasien.tgl_periksa, dbo.mt_icd_diagnosa.kode_icd_diagnosa AS kode_icd, dbo.mt_master_pasien.nama_pasien AS Expr1
FROM         dbo.th_riwayat_pasien INNER JOIN
                      dbo.mt_icd_diagnosa ON dbo.th_riwayat_pasien.kode_icd_diagnosa = dbo.mt_icd_diagnosa.kode_icd_diagnosa INNER JOIN
                      dbo.mt_master_pasien ON dbo.th_riwayat_pasien.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_nasabah ON dbo.mt_master_pasien.kode_kelompok = dbo.mt_nasabah.kode_kelompok
GROUP BY dbo.th_riwayat_pasien.no_registrasi, dbo.th_riwayat_pasien.no_mr, dbo.mt_icd_diagnosa.nama_diagnosa, dbo.th_riwayat_pasien.kode_icd_diagnosa, dbo.th_riwayat_pasien.diagnosa, 
                      dbo.mt_nasabah.nama_kelompok, dbo.th_riwayat_pasien.tgl_periksa, dbo.mt_icd_diagnosa.kode_icd_diagnosa, dbo.mt_master_pasien.nama_pasien
HAVING      (dbo.th_riwayat_pasien.no_mr = '060919')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_diagonsa_fisio_v]");
    }
};
