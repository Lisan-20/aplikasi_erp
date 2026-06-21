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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_kinerja_penilaian_v
AS
SELECT     dbo.mt_kinerja_penilaian.kelompok_kinerja, dbo.mt_kinerja_penilaian_det.keterangan, dbo.mt_kinerja_penilaian.status_kinerja, dbo.mt_kinerja_penilaian.tgl_awal, 
                      dbo.mt_kinerja_penilaian.tgl_akhir, dbo.mt_kinerja_penilaian.id_kinerja, dbo.mt_kinerja_penilaian.bobot, dbo.mt_kinerja_penilaian.nilai_min, dbo.mt_kinerja_penilaian.nilai_maks, 
                      dbo.mt_kinerja_penilaian_det.id_kinerja_det
FROM         dbo.mt_kinerja_penilaian INNER JOIN
                      dbo.mt_kinerja_penilaian_det ON dbo.mt_kinerja_penilaian.id_kinerja = dbo.mt_kinerja_penilaian_det.id_kinerja
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_kinerja_penilaian_v]");
    }
};
