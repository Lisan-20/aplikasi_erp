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
        DB::statement("CREATE VIEW dbo.hasilgigi2_v
AS
SELECT     dbo.tc_pem2fisik.kode_tc_pem2fisik, dbo.tc_pem2fisik.kode_pemeriksaan, dbo.tc_pem2fisik.no_kunjungan, dbo.tc_pem2fisik.id_mt_fisik_det, dbo.tc_pem2fisik.hasil, 
                      dbo.tc_pem2fisik.keterangan, dbo.tc_pem2fisik.kode_grup_tindakan, dbo.tc_pem2fisik.kode_bagian, dbo.tc_pem2fisik.id_mt_kesimpulan, 
                      dbo.mt_fisik_v.nama_pemeriksaan, dbo.mt_fisik_v.pemeriksaan_detail, dbo.mt_kesimpulan.kesimpulan, dbo.mt_saran.saran
FROM         dbo.mt_saran INNER JOIN
                      dbo.tc_pem2fisik_det ON dbo.mt_saran.id_mt_saran = dbo.tc_pem2fisik_det.id_mt_saran RIGHT OUTER JOIN
                      dbo.mt_fisik_v INNER JOIN
                      dbo.tc_pem2fisik ON dbo.mt_fisik_v.id_mt_fisik_det = dbo.tc_pem2fisik.id_mt_fisik_det LEFT OUTER JOIN
                      dbo.mt_kesimpulan ON dbo.mt_fisik_v.id_mt_fisik_det = dbo.mt_kesimpulan.id_mt_fisik_det AND 
                      dbo.tc_pem2fisik.id_mt_kesimpulan = dbo.mt_kesimpulan.id_mt_kesimpulan ON dbo.tc_pem2fisik_det.no_kunjungan = dbo.tc_pem2fisik.no_kunjungan AND 
                      dbo.tc_pem2fisik_det.id_mt_kesimpulan = dbo.tc_pem2fisik.id_mt_kesimpulan
WHERE     (dbo.mt_fisik_v.kode_pemeriksaan >= 100500) AND (dbo.mt_fisik_v.kode_pemeriksaan < 101800)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hasilgigi2_v]");
    }
};
