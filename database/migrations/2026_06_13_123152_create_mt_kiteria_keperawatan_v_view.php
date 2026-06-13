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
        DB::statement("CREATE VIEW dbo.mt_kiteria_keperawatan_v
AS
SELECT     dbo.mt_kiteria_keperawatan.id_kriteria, dbo.mt_kiteria_keperawatan.id_kep, dbo.mt_kiteria_keperawatan.id_pk, dbo.mt_keperawatan.nm_keperawatan, dbo.mt_perawat_klinik.nama_pk, 
                      dbo.mt_kiteria_keperawatan.nm_kriteria, dbo.mt_kiteria_keperawatan.no_urut, dbo.mt_kiteria_keperawatan.narasi
FROM         dbo.mt_kiteria_keperawatan INNER JOIN
                      dbo.mt_keperawatan ON dbo.mt_kiteria_keperawatan.id_kep = dbo.mt_keperawatan.id_kep INNER JOIN
                      dbo.mt_perawat_klinik ON dbo.mt_kiteria_keperawatan.id_pk = dbo.mt_perawat_klinik.id_pk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_kiteria_keperawatan_v]");
    }
};
