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
        DB::statement("CREATE OR ALTER VIEW dbo.view_dashboard_isi_fiks
AS
SELECT     dbo.mt_ruangan.kode_klas, dbo.mt_ruangan.kode_klas_bpjs, dbo.tb_dashboard.kelas_dan_ruang, dbo.mt_ruangan.kode_klas_bpjs AS kode_bpjs, COUNT(dbo.mt_ruangan.kode_ruangan) 
                      AS jml_bed, dbo.tb_dashboard.logo, COUNT(dbo.view_dashboard_isi.jml_bed) AS jml_isi, dbo.mt_ruangan.kode_ruangan, dbo.mt_ruangan.status
FROM         dbo.mt_ruangan INNER JOIN
                      dbo.tb_dashboard ON dbo.mt_ruangan.kode_klas_bpjs = dbo.tb_dashboard.kode_klas_bpjs LEFT OUTER JOIN
                      dbo.view_dashboard_isi ON dbo.tb_dashboard.kelas_dan_ruang = dbo.view_dashboard_isi.kelas_dan_ruang
GROUP BY dbo.mt_ruangan.kode_klas, dbo.mt_ruangan.kode_klas_bpjs, dbo.tb_dashboard.kelas_dan_ruang, dbo.mt_ruangan.flag_aktif, dbo.tb_dashboard.logo, dbo.mt_ruangan.kode_ruangan, 
                      dbo.mt_ruangan.status
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [view_dashboard_isi_fiks]");
    }
};
