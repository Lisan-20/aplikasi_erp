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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_icd_diagnosa_ri2_v
AS
SELECT        TOP (100) PERCENT nama_diagnosa, MAX(kode_icd_diagnosa) AS kode_icd_diagnosa, kode_icd
FROM            dbo.mt_icd_diagnosa
GROUP BY nama_diagnosa, kode_icd
ORDER BY nama_diagnosa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_icd_diagnosa_ri2_v]");
    }
};
