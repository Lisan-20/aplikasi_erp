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
        DB::statement("CREATE VIEW dbo.mt_icd_inacbg_diagnosa_rj_v
AS
SELECT     TOP (100) PERCENT dbo.tariff_cbg.[ tariff], dbo.tariff_cbg.kode_tariff, dbo.tariff_cbg.regional, dbo.tariff_cbg.kelas_rawat, dbo.tariff_cbg.[ jenis_pelayanan], dbo.mt_master_icd10_inacbgs.icd_x, 
                      dbo.mt_master_icd10_inacbgs.diagnosa, dbo.mt_master_icd10_inacbgs.out, dbo.tariff_cbg.inacbg
FROM         dbo.mt_master_icd10_inacbgs INNER JOIN
                      dbo.tariff_cbg ON dbo.mt_master_icd10_inacbgs.inacbg_out = dbo.tariff_cbg.inacbg
WHERE     (dbo.tariff_cbg.kode_tariff = N'DS') AND (dbo.tariff_cbg.regional = N'reg1') AND (dbo.tariff_cbg.[ jenis_pelayanan] = 2)
ORDER BY dbo.mt_master_icd10_inacbgs.icd_x
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_icd_inacbg_diagnosa_rj_v]");
    }
};
