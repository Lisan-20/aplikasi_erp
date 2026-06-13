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
        DB::statement("CREATE OR ALTER VIEW dbo.th_riwayat_pasien_grup
AS
SELECT     TOP (100) PERCENT MAX(dbo.th_riwayat_pasien.kode_riwayat) AS kode_riwayat, dbo.th_riwayat_pasien.no_registrasi, dbo.th_riwayat_pasien.no_mr, 
                      dbo.th_riwayat_pasien.diagnosa_akhir, MAX(dbo.th_riwayat_pasien.no_kunjungan) AS no_kunjungan
FROM         dbo.th_riwayat_pasien INNER JOIN
                      dbo.th_riwayat_pasien_max_v ON dbo.th_riwayat_pasien.kode_riwayat = dbo.th_riwayat_pasien_max_v.kode_riwayat AND 
                      dbo.th_riwayat_pasien.no_registrasi = dbo.th_riwayat_pasien_max_v.no_registrasi
GROUP BY dbo.th_riwayat_pasien.no_registrasi, dbo.th_riwayat_pasien.no_mr, dbo.th_riwayat_pasien.diagnosa_akhir
ORDER BY kode_riwayat DESC, MAX(dbo.th_riwayat_pasien.no_kunjungan) DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_riwayat_pasien_grup]");
    }
};
