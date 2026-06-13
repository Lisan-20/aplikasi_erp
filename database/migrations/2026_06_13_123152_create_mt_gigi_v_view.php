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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_gigi_v
AS
SELECT     dbo.tc_pem2fisik.kode_tc_pem2fisik, dbo.tc_pem2fisik.kode_pemeriksaan, dbo.tc_pem2fisik.no_kunjungan, dbo.tc_pem2fisik.id_mt_fisik_det, dbo.tc_pem2fisik.hasil, 
                      dbo.tc_pem2fisik.keterangan, dbo.tc_pem2fisik.kode_grup_tindakan, dbo.tc_pem2fisik.kode_bagian, dbo.tc_pem2fisik.id_mt_kesimpulan, 
                      dbo.mt_fisik_v.nama_pemeriksaan, dbo.mt_kesimpulan.kesimpulan, dbo.tc_pem2fisik_det.id_mt_saran, dbo.mt_saran.saran
FROM         dbo.mt_kesimpulan INNER JOIN
                      dbo.tc_pem2fisik_det INNER JOIN
                      dbo.mt_fisik_v INNER JOIN
                      dbo.tc_pem2fisik ON dbo.mt_fisik_v.id_mt_fisik_det = dbo.tc_pem2fisik.id_mt_fisik_det ON 
                      dbo.tc_pem2fisik_det.id_mt_kesimpulan = dbo.tc_pem2fisik.id_mt_kesimpulan INNER JOIN
                      dbo.mt_saran ON dbo.tc_pem2fisik_det.id_mt_saran = dbo.mt_saran.id_mt_saran ON 
                      dbo.mt_kesimpulan.id_mt_kesimpulan = dbo.tc_pem2fisik.id_mt_kesimpulan AND 
                      dbo.mt_kesimpulan.kode_pemeriksaan = dbo.tc_pem2fisik.kode_pemeriksaan
WHERE     (dbo.mt_fisik_v.kode_pemeriksaan = 101800)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_gigi_v]");
    }
};
