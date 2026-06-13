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
        DB::statement("CREATE OR ALTER VIEW dbo.xx_2
AS
SELECT     dbo.alt_diagnosis.severity, dbo.alt_diagnosis.code2 AS icd_10, dbo.mt_tariff_bpjs_ri.description AS INA_description, 
                      dbo.alt_diagnosis.description AS ICD_description, dbo.mt_tariff_bpjs_ri.kelas_3, dbo.mt_tariff_bpjs_ri.kelas_2, dbo.mt_tariff_bpjs_ri.kelas_1
FROM         dbo.alt_diagnosis INNER JOIN
                      dbo.mt_tariff_bpjs_ri ON dbo.alt_diagnosis.Inpatient2 = dbo.mt_tariff_bpjs_ri.code_ncc
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [xx_2]");
    }
};
