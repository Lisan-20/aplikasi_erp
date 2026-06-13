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
        DB::statement("CREATE VIEW dbo.mt_jawaban_benar_soal_v
AS
SELECT     dbo.jawaban_semua_soal_v.no_peserta, dbo.mt_bank_soal.id_mt_soal, dbo.mt_bank_soal.soal, dbo.mt_bank_soal.jawaban AS jawaban_benar, dbo.jawaban_semua_soal_v.jawaban
FROM         dbo.mt_bank_soal INNER JOIN
                      dbo.jawaban_semua_soal_v ON dbo.mt_bank_soal.id_mt_soal = dbo.jawaban_semua_soal_v.id_mt_soal AND dbo.mt_bank_soal.jawaban = dbo.jawaban_semua_soal_v.jawaban
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_jawaban_benar_soal_v]");
    }
};
