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
        DB::statement("CREATE OR ALTER VIEW dbo.test_bagian_soal_v
AS
SELECT     dbo.mt_bank_soal.id_mt_soal, dbo.mt_bank_soal.soal, dbo.mt_bank_soal.jawaban, dbo.mt_soal_bagian.kode_bagian, dbo.mt_bank_soal.kategori_soal, dbo.mt_bank_soal.id_tipe, 
                      dbo.mt_bank_soal.no_urut
FROM         dbo.mt_bank_soal INNER JOIN
                      dbo.mt_soal_bagian ON dbo.mt_bank_soal.id_mt_soal = dbo.mt_soal_bagian.id_mt_soal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [test_bagian_soal_v]");
    }
};
