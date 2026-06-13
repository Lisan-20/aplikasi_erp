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
        DB::statement("CREATE OR ALTER VIEW dbo.hasil_gigi_v
AS
SELECT     dbo.tc_pem2fisik.kode_pemeriksaan, dbo.tc_pem2fisik.no_kunjungan, dbo.tc_pem2fisik.id_mt_fisik_det, dbo.tc_pem2fisik.hasil, dbo.tc_pem2fisik.keterangan, 
                      dbo.tc_pem2fisik.kode_grup_tindakan, dbo.tc_pem2fisik.kode_bagian, dbo.tc_pem2fisik.id_mt_kesimpulan, dbo.mt_prik_gigi.warna
FROM         dbo.tc_pem2fisik INNER JOIN
                      dbo.mt_prik_gigi ON dbo.tc_pem2fisik.hasil = dbo.mt_prik_gigi.no_prik_gigi
WHERE     (dbo.tc_pem2fisik.kode_pemeriksaan = N'101800')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hasil_gigi_v]");
    }
};
