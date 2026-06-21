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
        DB::statement("CREATE OR ALTER VIEW dbo.hasil_angket_bkk2
AS
SELECT     dbo.mt_survey_rs.id_pertanyaan, dbo.mt_survey_rs_det.jawaban, dbo.mt_survey_rs.pertanyaan, dbo.hasil_angket_bkk.id_jawaban, dbo.hasil_angket_bkk.komentar, 
                      dbo.hasil_angket_bkk.id_pertanyaan_det, dbo.mt_survey_rs.kode_kelompok, COUNT(dbo.mt_survey_rs_det.jawaban) AS jawaban1, dbo.hasil_angket_bkk.id_periode_survey
FROM         dbo.hasil_angket_bkk INNER JOIN
                      dbo.mt_survey_rs_det ON dbo.hasil_angket_bkk.id_pertanyaan_det = dbo.mt_survey_rs_det.id_pertanyaan_det RIGHT OUTER JOIN
                      dbo.mt_survey_rs ON dbo.mt_survey_rs_det.id_pertanyaan = dbo.mt_survey_rs.id_pertanyaan
GROUP BY dbo.mt_survey_rs.id_pertanyaan, dbo.mt_survey_rs_det.jawaban, dbo.mt_survey_rs.pertanyaan, dbo.hasil_angket_bkk.id_jawaban, dbo.hasil_angket_bkk.komentar, 
                      dbo.hasil_angket_bkk.id_pertanyaan_det, dbo.mt_survey_rs.kode_kelompok, dbo.hasil_angket_bkk.id_periode_survey
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hasil_angket_bkk2]");
    }
};
