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
        DB::statement("CREATE OR ALTER VIEW dbo.plafon_test_v
AS
SELECT     TOP (100) PERCENT dbo.tc_registrasi.kode_plafon, dbo.ri_tc_riwayat_kelas.no_registrasi, dbo.ri_tc_riwayat_kelas.bagian_tujuan
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.ri_tc_riwayat_kelas ON dbo.tc_registrasi.no_registrasi = dbo.ri_tc_riwayat_kelas.no_registrasi
WHERE     (dbo.tc_registrasi.kode_plafon = '') AND (dbo.tc_registrasi.status_batal IS NULL) AND (NOT (dbo.ri_tc_riwayat_kelas.bagian_tujuan = 'in  030601. 030901'))
ORDER BY dbo.ri_tc_riwayat_kelas.bagian_tujuan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [plafon_test_v]");
    }
};
