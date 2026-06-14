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
        DB::statement("CREATE OR ALTER VIEW dbo.view_dashboard_fiks
AS
SELECT     dbo.mt_ruangan.kode_klas_bpjs, dbo.tb_dashboard.kelas_dan_ruang, dbo.mt_ruangan.kode_klas_bpjs AS kode_bpjs, COUNT(dbo.mt_ruangan.kode_ruangan) AS jml_bed, dbo.tb_dashboard.logo, 
                      COUNT(dbo.view_dashboard_isi.jml_bed) AS jml_isi, dbo.tb_dashboard.jml_bed AS jml_bed_asli, dbo.tb_dashboard.no
FROM         dbo.mt_ruangan RIGHT OUTER JOIN
                      dbo.tb_dashboard ON dbo.mt_ruangan.kode_klas_bpjs = dbo.tb_dashboard.kode_klas_bpjs LEFT OUTER JOIN
                      dbo.view_dashboard_isi ON dbo.tb_dashboard.kelas_dan_ruang = dbo.view_dashboard_isi.kelas_dan_ruang
WHERE     (dbo.mt_ruangan.flag_aktif IS NULL OR
                      dbo.mt_ruangan.flag_aktif <> 1)
GROUP BY dbo.mt_ruangan.kode_klas_bpjs, dbo.tb_dashboard.kelas_dan_ruang, dbo.tb_dashboard.logo, dbo.tb_dashboard.jml_bed, dbo.tb_dashboard.no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [view_dashboard_fiks]");
    }
};
