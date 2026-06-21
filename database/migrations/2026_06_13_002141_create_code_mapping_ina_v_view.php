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
        DB::statement("CREATE OR ALTER VIEW dbo.code_mapping_ina_v
AS
SELECT     TOP (100) PERCENT dbo.alt_diagnosis.severity, dbo.alt_diagnosis.code2 AS icd_10, dbo.mt_tariff_bpjs_ri.code AS icd_ina, dbo.mt_tariff_bpjs_ri.description AS INA_description, 
                      dbo.alt_diagnosis.description1 AS ICD_description, dbo.mt_tariff_bpjs_ri.kelas_3, dbo.mt_tariff_bpjs_ri.kelas_2, dbo.mt_tariff_bpjs_ri.kelas_1, dbo.mt_tariff_bpjs_ri.code, 
                      dbo.alt_diagnosis.description1 AS description, dbo.mt_tariff_bpjs_ri.alos, dbo.alt_diagnosis.code AS Expr1, dbo.mt_icd_diagnosa.flag_diag, dbo.mt_icd_diagnosa.nama_diagnosa, 
                      dbo.mt_icd_diagnosa.kode_icd_diagnosa, dbo.mt_icd_diagnosa.id_mt_icd_diagnosa
FROM         dbo.alt_diagnosis INNER JOIN
                      dbo.mt_tariff_bpjs_ri ON dbo.alt_diagnosis.Inpatient2 = dbo.mt_tariff_bpjs_ri.code_ncc INNER JOIN
                      dbo.mt_icd_diagnosa ON dbo.alt_diagnosis.code2 = dbo.mt_icd_diagnosa.kode_icd
WHERE     (dbo.mt_tariff_bpjs_ri.code LIKE N'%-i')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [code_mapping_ina_v]");
    }
};
