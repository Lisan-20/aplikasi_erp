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
        DB::statement("CREATE VIEW dbo.mt_bobot_kinerja_detail_v
AS
SELECT     dbo.mt_bobot_kinerja_detail.nilai, dbo.mt_bobot_kinerja_detail.bobot, dbo.mt_kinerja_penilaian_det.id_kinerja_det
FROM         dbo.mt_bobot_kinerja_detail INNER JOIN
                      dbo.mt_kinerja_penilaian ON dbo.mt_bobot_kinerja_detail.id_bobot = dbo.mt_kinerja_penilaian.id_bobot INNER JOIN
                      dbo.mt_kinerja_penilaian_det ON dbo.mt_kinerja_penilaian.id_kinerja = dbo.mt_kinerja_penilaian_det.id_kinerja
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_bobot_kinerja_detail_v]");
    }
};
