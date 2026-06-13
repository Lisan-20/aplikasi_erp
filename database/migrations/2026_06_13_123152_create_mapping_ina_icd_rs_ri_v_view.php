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
        DB::statement("CREATE VIEW dbo.mapping_ina_icd_rs_ri_v
AS
SELECT     dbo.alt_diagnosis.severity, dbo.alt_diagnosis.code2 AS icd_10, dbo.mt_tariff_bpjs_ri.code AS icd_ina, dbo.mt_tariff_bpjs_ri.description AS INA_description, 
                      dbo.alt_diagnosis.description1 AS ICD_description, dbo.diagnosa_rs.DIAGNOSIS_UTAMA AS RS_description, dbo.mt_tariff_bpjs_ri.kelas_3, 
                      dbo.mt_tariff_bpjs_ri.kelas_2, dbo.mt_tariff_bpjs_ri.kelas_1, dbo.mt_tariff_bpjs_ri.code, dbo.alt_diagnosis.description1 AS description, dbo.mt_tariff_bpjs_ri.alos, 
                      dbo.alt_diagnosis.code AS Expr1
FROM         dbo.alt_diagnosis INNER JOIN
                      dbo.mt_tariff_bpjs_ri ON dbo.alt_diagnosis.Inpatient2 = dbo.mt_tariff_bpjs_ri.code_ncc INNER JOIN
                      dbo.diagnosa_rs ON dbo.alt_diagnosis.code2 = dbo.diagnosa_rs.KODE_ICD_10
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mapping_ina_icd_rs_ri_v]");
    }
};
