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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_fisik_v
AS
SELECT     dbo.mt_fisik.nama_pemeriksaan, dbo.mt_fisik_det.id_mt_fisik_det, dbo.mt_fisik_det.pemeriksaan_detail, dbo.mt_fisik_det.kode_bagian, 
                      dbo.mt_fisik_det.kode_grup_tindakan, dbo.mt_fisik_det.kode_pemeriksaan, dbo.mt_fisik.id_mt_fisik, dbo.mt_fisik.no_urut, 
                      dbo.mt_fisik_det.no_urut_det
FROM         dbo.mt_fisik FULL OUTER JOIN
                      dbo.mt_fisik_det ON dbo.mt_fisik.kode_pemeriksaan = dbo.mt_fisik_det.kode_pemeriksaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_fisik_v]");
    }
};
