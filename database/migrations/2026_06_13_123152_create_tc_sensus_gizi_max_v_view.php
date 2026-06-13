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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_sensus_gizi_max_v
AS
SELECT     dbo.tc_sensus_gizi.no_registrasi, dbo.tc_sensus_gizi.kode_diet AS diet, dbo.tc_sensus_gizi.kode_icd_diagnosa, dbo.mt_diet.nama_diet, 
                      MAX(dbo.tc_sensus_gizi.id_tc_sensus_gizi) AS id_tc_sensus_gizi, dbo.tc_sensus_gizi.no_mr, dbo.mt_diet.kode_diet
FROM         dbo.tc_sensus_gizi INNER JOIN
                      dbo.mt_diet ON dbo.tc_sensus_gizi.kode_diet = dbo.mt_diet.kode_diet
GROUP BY dbo.tc_sensus_gizi.no_registrasi, dbo.tc_sensus_gizi.kode_diet, dbo.tc_sensus_gizi.kode_icd_diagnosa, dbo.mt_diet.nama_diet, 
                      dbo.tc_sensus_gizi.no_mr, dbo.mt_diet.kode_diet
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_sensus_gizi_max_v]");
    }
};
