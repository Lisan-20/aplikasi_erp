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
        DB::statement("CREATE VIEW dbo.mt_icd_inacbg_diagnosa_v
AS
SELECT     dbo.tariff_cbg.[ tariff], dbo.tariff_cbg.kode_tariff, dbo.tariff_cbg.regional, dbo.tariff_cbg.kelas_rawat, dbo.tariff_cbg.[ jenis_pelayanan], dbo.view_alt_diagnosis_split.inacbg_inp, 
                      dbo.view_alt_diagnosis_split.Inpatient, dbo.view_alt_diagnosis_split.description AS diagnosa, dbo.view_alt_diagnosis_split.code2 AS icd_x
FROM         dbo.tariff_cbg INNER JOIN
                      dbo.view_alt_diagnosis_split ON dbo.tariff_cbg.inp = dbo.view_alt_diagnosis_split.inacbg_inp
WHERE     (dbo.tariff_cbg.kode_tariff = N'DS') AND (dbo.tariff_cbg.regional = N'reg1') AND (dbo.tariff_cbg.[ jenis_pelayanan] = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_icd_inacbg_diagnosa_v]");
    }
};
