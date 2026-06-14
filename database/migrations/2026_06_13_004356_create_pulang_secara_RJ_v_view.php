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
        DB::statement("CREATE OR ALTER VIEW dbo.pulang_secara_RJ_v
AS
SELECT     TOP (100) PERCENT COUNT(dbo.lap_kunjungan_igd_all_v.no_kunjungan) AS jmlpas, dbo.gd_daftar_antrian_pulang_v.status_periksa, DAY(dbo.gd_daftar_antrian_pulang_v.tgl_masuk) AS tglmasuk, 
                      MONTH(dbo.gd_daftar_antrian_pulang_v.tgl_masuk) AS blnmasuk, YEAR(dbo.gd_daftar_antrian_pulang_v.tgl_masuk) AS thnmasuk, dbo.gd_daftar_antrian_pulang_v.stat_celaka
FROM         dbo.lap_kunjungan_igd_all_v INNER JOIN
                      dbo.gd_daftar_antrian_pulang_v ON dbo.lap_kunjungan_igd_all_v.no_kunjungan = dbo.gd_daftar_antrian_pulang_v.no_kunjungan
GROUP BY dbo.gd_daftar_antrian_pulang_v.status_periksa, DAY(dbo.gd_daftar_antrian_pulang_v.tgl_masuk), MONTH(dbo.gd_daftar_antrian_pulang_v.tgl_masuk), 
                      YEAR(dbo.gd_daftar_antrian_pulang_v.tgl_masuk), dbo.gd_daftar_antrian_pulang_v.stat_celaka
HAVING      (dbo.gd_daftar_antrian_pulang_v.status_periksa = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pulang_secara_RJ_v]");
    }
};
