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
        DB::statement("CREATE OR ALTER VIEW dbo.sensus_gizi_per_jenis_diet_v
AS
SELECT     COUNT(dbo.tc_sensus_gizi.kode_diet) AS jumlah, dbo.mt_diet_v.nama_diet
FROM         dbo.v_sensus_gizi_ok INNER JOIN
                      dbo.tc_sensus_gizi ON dbo.v_sensus_gizi_ok.id_sensus_gizi = dbo.tc_sensus_gizi.id_tc_sensus_gizi INNER JOIN
                      dbo.mt_diet_v ON dbo.tc_sensus_gizi.kode_diet = dbo.mt_diet_v.kode_diet
GROUP BY dbo.mt_diet_v.nama_diet
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sensus_gizi_per_jenis_diet_v]");
    }
};
