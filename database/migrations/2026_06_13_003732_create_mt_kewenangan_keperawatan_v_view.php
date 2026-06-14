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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_kewenangan_keperawatan_v
AS
SELECT     dbo.mt_kewenangan_keperawatan.id_kewenangan, dbo.mt_kewenangan_keperawatan.id_kep, dbo.mt_kewenangan_keperawatan.id_pk, dbo.mt_kewenangan_keperawatan.kd_lev, 
                      dbo.mt_kewenangan_keperawatan.kd_periksa, dbo.mt_kewenangan_keperawatan.kd_ref, dbo.mt_kewenangan_keperawatan.kd_type, dbo.mt_kewenangan_keperawatan.nm_kewenangan, 
                      dbo.mt_perawat_klinik.nama_pk, dbo.mt_keperawatan.nm_keperawatan
FROM         dbo.mt_kewenangan_keperawatan INNER JOIN
                      dbo.mt_keperawatan ON dbo.mt_kewenangan_keperawatan.id_kep = dbo.mt_keperawatan.id_kep INNER JOIN
                      dbo.mt_perawat_klinik ON dbo.mt_kewenangan_keperawatan.id_pk = dbo.mt_perawat_klinik.id_pk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_kewenangan_keperawatan_v]");
    }
};
