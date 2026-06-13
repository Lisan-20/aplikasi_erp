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
        DB::statement("CREATE VIEW dbo.jawaban_soal_v
AS
SELECT     dbo.mt_bank_soal_det.detail_soal, dbo.tc_jawab_soal.jawaban, dbo.tc_jawab_soal.no_peserta, dbo.tc_jawab_soal.no_urut, dbo.mt_bank_soal_det.id_mt_bank_soal_det, 
                      dbo.mt_bank_soal_det.id_mt_soal
FROM         dbo.mt_bank_soal_det LEFT OUTER JOIN
                      dbo.tc_jawab_soal ON dbo.mt_bank_soal_det.id_mt_soal = dbo.tc_jawab_soal.id_mt_soal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jawaban_soal_v]");
    }
};
