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
        DB::statement("CREATE OR ALTER VIEW dbo.view_dashboard_group
AS
SELECT     dbo.mt_ruangan.kode_klas_bpjs, dbo.tb_dashboard.kelas_dan_ruang, dbo.mt_ruangan.kode_klas_bpjs AS kode_bpjs, dbo.mt_bagian.nama_bagian, COUNT(dbo.mt_ruangan.kode_ruangan) 
                      AS jml_bed, dbo.mt_bagian.kode_bagian
FROM         dbo.mt_ruangan INNER JOIN
                      dbo.tb_dashboard ON dbo.mt_ruangan.kode_klas_bpjs = dbo.tb_dashboard.kode_klas_bpjs INNER JOIN
                      dbo.mt_bagian ON dbo.mt_ruangan.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.mt_ruangan.flag_aktif IS NULL OR
                      dbo.mt_ruangan.flag_aktif <> 1)
GROUP BY dbo.mt_ruangan.kode_klas_bpjs, dbo.tb_dashboard.kelas_dan_ruang, dbo.mt_bagian.nama_bagian, dbo.mt_bagian.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [view_dashboard_group]");
    }
};
