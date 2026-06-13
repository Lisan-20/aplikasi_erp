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
        DB::statement("CREATE OR ALTER VIEW dbo.rm_morbilitas_v
AS
SELECT     TOP 10 dbo.mt_icd_diagnosa.nama_diagnosa, COUNT(*) AS jumlah, dbo.th_riwayat_pasien.kode_icd_diagnosa, 
                      dbo.th_riwayat_pasien.tgl_periksa
FROM         dbo.th_riwayat_pasien INNER JOIN
                      dbo.mt_icd_diagnosa ON dbo.th_riwayat_pasien.kode_icd_diagnosa = dbo.mt_icd_diagnosa.kode_icd_diagnosa
GROUP BY dbo.th_riwayat_pasien.diagnosa_akhir, dbo.mt_icd_diagnosa.nama_diagnosa, dbo.th_riwayat_pasien.kode_icd_diagnosa, 
                      dbo.th_riwayat_pasien.tgl_periksa
ORDER BY jumlah DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rm_morbilitas_v]");
    }
};
