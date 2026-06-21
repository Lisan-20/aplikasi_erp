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
        DB::statement("CREATE OR ALTER VIEW dbo.v_sensus_gizi_ok
AS
SELECT     dbo.ri_cari_pasien_v.no_registrasi AS jumlah, dbo.ri_cari_pasien_v.no_registrasi, MAX(dbo.tc_sensus_gizi.id_tc_sensus_gizi) AS id_sensus_gizi
FROM         dbo.ri_cari_pasien_v INNER JOIN
                      dbo.tc_sensus_gizi ON dbo.ri_cari_pasien_v.no_mr = dbo.tc_sensus_gizi.no_mr AND dbo.ri_cari_pasien_v.no_registrasi = dbo.tc_sensus_gizi.no_registrasi
GROUP BY dbo.ri_cari_pasien_v.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sensus_gizi_ok]");
    }
};
