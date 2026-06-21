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
        DB::statement("CREATE OR ALTER VIEW dbo.kinerja_penilaian_lv1_v
AS
SELECT     dbo.mt_kinerja_penilaian_det.id_kinerja_det, dbo.mt_kinerja_penilaian_det.id_kinerja, dbo.mt_kinerja_penilaian.id_bobot, dbo.tc_penilaian_kinerja_det.nilai
FROM         dbo.tc_penilaian_kinerja_det INNER JOIN
                      dbo.mt_kinerja_penilaian_det ON dbo.tc_penilaian_kinerja_det.id_kinerja_det = dbo.mt_kinerja_penilaian_det.id_kinerja_det INNER JOIN
                      dbo.mt_kinerja_penilaian ON dbo.mt_kinerja_penilaian_det.id_kinerja = dbo.mt_kinerja_penilaian.id_kinerja
WHERE     (dbo.mt_kinerja_penilaian.id_bobot = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kinerja_penilaian_lv1_v]");
    }
};
