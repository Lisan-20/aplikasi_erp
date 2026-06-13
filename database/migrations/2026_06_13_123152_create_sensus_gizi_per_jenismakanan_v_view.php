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
        DB::statement("CREATE VIEW dbo.sensus_gizi_per_jenismakanan_v
AS
SELECT     dbo.ri_cari_pasien_v.no_mr, dbo.ri_cari_pasien_v.no_registrasi
FROM         dbo.ri_cari_pasien_v INNER JOIN
                      dbo.tc_sensus_diet_gizi_v ON dbo.ri_cari_pasien_v.no_mr = dbo.tc_sensus_diet_gizi_v.no_mr AND dbo.ri_cari_pasien_v.no_registrasi = dbo.tc_sensus_diet_gizi_v.no_registrasi
GROUP BY dbo.ri_cari_pasien_v.no_mr, dbo.ri_cari_pasien_v.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sensus_gizi_per_jenismakanan_v]");
    }
};
