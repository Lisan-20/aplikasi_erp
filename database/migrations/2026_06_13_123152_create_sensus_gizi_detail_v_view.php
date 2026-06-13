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
        DB::statement("CREATE OR ALTER VIEW dbo.sensus_gizi_detail_v
AS
SELECT     dbo.ri_cari_pasien_v.no_registrasi, dbo.gizi_max_v.id_tc_sensus_gizi, dbo.tc_sensus_gizi.diet
FROM         dbo.ri_cari_pasien_v INNER JOIN
                      dbo.gizi_max_v ON dbo.ri_cari_pasien_v.no_registrasi = dbo.gizi_max_v.no_registrasi INNER JOIN
                      dbo.tc_sensus_gizi ON dbo.gizi_max_v.id_tc_sensus_gizi = dbo.tc_sensus_gizi.id_tc_sensus_gizi AND 
                      dbo.gizi_max_v.no_registrasi = dbo.tc_sensus_gizi.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sensus_gizi_detail_v]");
    }
};
