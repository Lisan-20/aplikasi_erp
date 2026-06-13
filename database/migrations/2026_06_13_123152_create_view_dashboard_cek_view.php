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
        DB::statement("CREATE VIEW dbo.view_dashboard_cek
AS
SELECT     ISNULL(dbo.view_dashboard_kosong.jml_kosong, 0) AS jml_kosong, ISNULL(dbo.th_upd_aplicare.jml_kosong, 0) AS jml_kosong_th, dbo.view_dashboard_group.kode_bpjs, 
                      dbo.view_dashboard_group.kode_bagian, dbo.view_dashboard_group.nama_bagian, dbo.view_dashboard_group.jml_bed
FROM         dbo.view_dashboard_kosong RIGHT OUTER JOIN
                      dbo.view_dashboard_group ON dbo.view_dashboard_kosong.kode_klas_bpjs = dbo.view_dashboard_group.kode_bpjs AND 
                      dbo.view_dashboard_kosong.kode_bagian = dbo.view_dashboard_group.kode_bagian AND dbo.view_dashboard_kosong.nama_bagian = dbo.view_dashboard_group.nama_bagian LEFT OUTER JOIN
                      dbo.th_upd_aplicare ON dbo.th_upd_aplicare.kode_bagian = dbo.view_dashboard_group.kode_bagian AND dbo.th_upd_aplicare.nama_bagian = dbo.view_dashboard_group.nama_bagian AND 
                      dbo.th_upd_aplicare.kode_klas_bpjs = dbo.view_dashboard_group.kode_bpjs
WHERE     (ISNULL(dbo.th_upd_aplicare.jml_kosong, 0) <> ISNULL(dbo.view_dashboard_kosong.jml_kosong, 0)) OR
                      (ISNULL(dbo.th_upd_aplicare.jml_kosong, 0) IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [view_dashboard_cek]");
    }
};
