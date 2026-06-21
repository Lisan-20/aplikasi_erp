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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_sensus_diet_gizi_v
AS
SELECT     dbo.tc_sensus_gizi.no_registrasi, dbo.tc_sensus_gizi.no_mr
FROM         dbo.tc_sensus_gizi INNER JOIN
                      dbo.ri_cari_pasien_v ON dbo.tc_sensus_gizi.no_registrasi = dbo.ri_cari_pasien_v.no_registrasi
GROUP BY dbo.tc_sensus_gizi.no_registrasi, dbo.tc_sensus_gizi.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_sensus_diet_gizi_v]");
    }
};
