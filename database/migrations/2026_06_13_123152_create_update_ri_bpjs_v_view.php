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
        DB::statement("CREATE OR ALTER VIEW dbo.update_ri_bpjs_v
AS
SELECT     dbo.tariff_2012_1_rsuc_ri.code, CAST(dbo.tariff_2012_1_rsuc_ri.code AS char(6)) AS inpat, dbo.tariff_2012_1_rsuc_ri.kelas_3, dbo.tariff_2012_1_rsuc_ri.kelas_2, 
                      dbo.tariff_2012_1_rsuc_ri.kelas_1, dbo.mt_tariff_bpjs_ri.kelas_3 AS up1, dbo.mt_tariff_bpjs_ri.kelas_2 AS up2, dbo.mt_tariff_bpjs_ri.kelas_1 AS up3, 
                      dbo.mt_tariff_bpjs_ri.code_ncc
FROM         dbo.tariff_2012_1_rsuc_ri INNER JOIN
                      dbo.mt_tariff_bpjs_ri ON dbo.tariff_2012_1_rsuc_ri.code = dbo.mt_tariff_bpjs_ri.code
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_ri_bpjs_v]");
    }
};
