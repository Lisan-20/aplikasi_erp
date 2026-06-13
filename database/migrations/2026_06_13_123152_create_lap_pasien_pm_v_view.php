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
        DB::statement("CREATE VIEW dbo.lap_pasien_pm_v
AS
SELECT     dbo.tc_kunjungan.no_kunjungan, dbo.pm_tc_penunjang.dr_pengirim, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, 
                      dbo.tc_kunjungan.kode_dokter, dbo.tc_kunjungan.no_mr
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.pm_tc_penunjang ON dbo.tc_kunjungan.no_kunjungan = dbo.pm_tc_penunjang.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '05%') AND (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_pasien_pm_v]");
    }
};
