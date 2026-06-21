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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_bank_soal_v
AS
SELECT     dbo.tc_jawab_soal.id_jawab, dbo.tc_jawab_soal.no_peserta, dbo.tc_jawab_soal.id_mt_soal, dbo.tc_jawab_soal.id_mt_bank_soal_det, dbo.tc_jawab_soal.jawaban, 
                      dbo.mt_bank_soal.id_mt_soal AS Expr1, dbo.mt_bank_soal.soal
FROM         dbo.tc_jawab_soal INNER JOIN
                      dbo.mt_bank_soal ON dbo.tc_jawab_soal.id_mt_soal = dbo.mt_bank_soal.id_mt_soal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_bank_soal_v]");
    }
};
