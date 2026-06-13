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
        DB::statement("CREATE VIEW dbo.sensus_gizi_detail_kelas_v
AS
SELECT     COUNT(dbo.ri_cari_pasien_v.no_registrasi) AS jumlah, dbo.mt_klas.nama_klas
FROM         dbo.ri_cari_pasien_v INNER JOIN
                      dbo.mt_klas ON dbo.ri_cari_pasien_v.kelas_pas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.tc_sensus_gizi_max_v ON dbo.ri_cari_pasien_v.no_registrasi = dbo.tc_sensus_gizi_max_v.no_registrasi AND 
                      dbo.ri_cari_pasien_v.no_mr = dbo.tc_sensus_gizi_max_v.no_mr
GROUP BY dbo.mt_klas.nama_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sensus_gizi_detail_kelas_v]");
    }
};
