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
        DB::statement("CREATE VIEW dbo.mapping_tariff_inacbg_diag_v
AS
SELECT     TOP (100) PERCENT dbo.alt_diagnosis.severity, dbo.alt_diagnosis.code2 AS icd_10, dbo.alt_diagnosis.description1 AS ICD_description, dbo.alt_diagnosis.description1 AS description, 
                      dbo.alt_diagnosis.code, dbo.mt_icd_diagnosa.flag_diag, dbo.mt_icd_diagnosa.nama_diagnosa, dbo.mt_icd_diagnosa.kode_icd_diagnosa, dbo.mt_icd_diagnosa.id_mt_icd_diagnosa, 
                      dbo.mt_icd_inacbg_diagnosa_v.[ tariff], dbo.mt_icd_inacbg_diagnosa_v.kelas_rawat, dbo.mt_icd_inacbg_diagnosa_v.inacbg_inp, dbo.mt_icd_inacbg_diagnosa_v.icd_x
FROM         dbo.alt_diagnosis INNER JOIN
                      dbo.mt_icd_inacbg_diagnosa_v ON dbo.alt_diagnosis.code2 = dbo.mt_icd_inacbg_diagnosa_v.icd_x INNER JOIN
                      dbo.mt_icd_diagnosa ON dbo.alt_diagnosis.code2 = dbo.mt_icd_diagnosa.kode_icd
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mapping_tariff_inacbg_diag_v]");
    }
};
