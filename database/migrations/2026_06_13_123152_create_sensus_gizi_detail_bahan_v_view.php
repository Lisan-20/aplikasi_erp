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
        DB::statement("CREATE OR ALTER VIEW dbo.sensus_gizi_detail_bahan_v
AS
SELECT     dbo.mt_diet_v.nm_kel_diet, COUNT(dbo.tc_sensus_gizi_max_v.no_registrasi) AS jumlah
FROM         dbo.ri_cari_pasien_v INNER JOIN
                      dbo.tc_sensus_gizi_max_v ON dbo.ri_cari_pasien_v.no_mr = dbo.tc_sensus_gizi_max_v.no_mr AND 
                      dbo.ri_cari_pasien_v.no_registrasi = dbo.tc_sensus_gizi_max_v.no_registrasi INNER JOIN
                      dbo.mt_diet_v ON dbo.tc_sensus_gizi_max_v.kode_diet = dbo.mt_diet_v.kode_diet
GROUP BY dbo.mt_diet_v.nm_kel_diet
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sensus_gizi_detail_bahan_v]");
    }
};
