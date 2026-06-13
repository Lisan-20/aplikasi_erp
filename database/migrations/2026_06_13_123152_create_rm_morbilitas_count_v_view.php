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
        DB::statement("CREATE VIEW dbo.rm_morbilitas_count_v
AS
SELECT     TOP 10 COUNT(*) AS jumlah, dbo.th_riwayat_pasien.kode_icd_diagnosa, dbo.mt_icd_diagnosa.nama_diagnosa
FROM         dbo.th_riwayat_pasien LEFT OUTER JOIN
                      dbo.mt_icd_diagnosa ON dbo.th_riwayat_pasien.kode_icd_diagnosa = dbo.mt_icd_diagnosa.kode_icd_diagnosa
WHERE     (dbo.th_riwayat_pasien.tgl_periksa IS NOT NULL) AND (dbo.th_riwayat_pasien.no_mr IS NOT NULL)
GROUP BY dbo.th_riwayat_pasien.kode_icd_diagnosa, dbo.mt_icd_diagnosa.nama_diagnosa
ORDER BY jumlah DESC, dbo.th_riwayat_pasien.kode_icd_diagnosa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rm_morbilitas_count_v]");
    }
};
