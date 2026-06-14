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
        DB::statement("CREATE OR ALTER VIEW dbo.diagnosa_gizi_v
AS
SELECT     TOP (100) PERCENT id_tc_sensus_gizi, MAX(kode_icd_diagnosa) AS kode_icd_diagnosa, no_registrasi, kode_diet
FROM         dbo.tc_sensus_gizi
GROUP BY id_tc_sensus_gizi, no_registrasi, kode_diet
ORDER BY id_tc_sensus_gizi DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [diagnosa_gizi_v]");
    }
};
