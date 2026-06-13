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
        DB::statement("CREATE VIEW dbo.update_bpjs_tarif_v
AS
SELECT     dbo.mt_tariff_bpjs_ri.kelas_3, dbo.mt_tariff_bpjs_ri.kelas_2, dbo.mt_tariff_bpjs_ri.kelas_1, dbo.tariff_2012_1_rsuc_ri.kelas_3 AS kelas_3up, dbo.tariff_2012_1_rsuc_ri.kelas_2 AS kelas_2up, 
                      dbo.tariff_2012_1_rsuc_ri.kelas_1 AS kelas_1up
FROM         dbo.mt_tariff_bpjs_ri INNER JOIN
                      dbo.tariff_2012_1_rsuc_ri ON dbo.mt_tariff_bpjs_ri.code = dbo.tariff_2012_1_rsuc_ri.code
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bpjs_tarif_v]");
    }
};
