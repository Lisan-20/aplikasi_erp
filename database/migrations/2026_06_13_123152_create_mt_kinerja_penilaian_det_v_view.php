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
        DB::statement("CREATE VIEW dbo.mt_kinerja_penilaian_det_v
AS
SELECT     dbo.mt_kinerja_penilaian.ket_kinerja, dbo.mt_kinerja_penilaian_det.id_kinerja_det, dbo.mt_kinerja_penilaian_det.skor, dbo.mt_kinerja_penilaian_det.keterangan, 
                      dbo.mt_kinerja_penilaian_det.input_id, dbo.mt_kinerja_penilaian_det.input_tgl, dbo.mt_kinerja_penilaian_det.status, dbo.mt_kinerja_penilaian_det.status_tgl, 
                      dbo.mt_kinerja_penilaian.id_kinerja
FROM         dbo.mt_kinerja_penilaian INNER JOIN
                      dbo.mt_kinerja_penilaian_det ON dbo.mt_kinerja_penilaian.id_kinerja = dbo.mt_kinerja_penilaian_det.id_kinerja
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_kinerja_penilaian_det_v]");
    }
};
