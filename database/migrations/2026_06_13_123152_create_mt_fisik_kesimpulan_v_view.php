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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_fisik_kesimpulan_v
AS
SELECT     dbo.mt_fisik_v.nama_pemeriksaan, dbo.mt_fisik_v.id_mt_fisik_det, dbo.mt_fisik_v.pemeriksaan_detail, dbo.mt_fisik_v.kode_bagian, 
                      dbo.mt_fisik_v.kode_grup_tindakan, dbo.mt_fisik_v.kode_pemeriksaan, dbo.mt_fisik_v.id_mt_fisik, dbo.mt_fisik_v.no_urut, 
                      dbo.mt_kesimpulan.kesimpulan, dbo.mt_kesimpulan.kode_pemeriksaan AS Expr1, dbo.mt_kesimpulan.id_mt_kesimpulan
FROM         dbo.mt_fisik_v LEFT OUTER JOIN
                      dbo.mt_kesimpulan ON dbo.mt_fisik_v.id_mt_fisik_det = dbo.mt_kesimpulan.id_mt_fisik_det
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_fisik_kesimpulan_v]");
    }
};
