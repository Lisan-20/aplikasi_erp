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
        DB::statement("CREATE OR ALTER VIEW dbo.v_update_LIS
AS
SELECT     lis_sysmax.dbo.LIS_ORDER.ONO AS ONO_LIS, LIS_ORDER_1.ONO AS ONO_HIS, dbo.pm_tc_penunjang.kode_penunjang, 
                      dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.kode_bagian_tujuan, lis_sysmax.dbo.LIS_ORDER.ID
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.pm_tc_penunjang ON dbo.tc_kunjungan.no_kunjungan = dbo.pm_tc_penunjang.no_kunjungan INNER JOIN
                      lis_sysmax.dbo.LIS_ORDER INNER JOIN
                      dbo.LIS_ORDER AS LIS_ORDER_1 ON lis_sysmax.dbo.LIS_ORDER.ID = LIS_ORDER_1.ID ON 
                      dbo.tc_kunjungan.no_registrasi = LIS_ORDER_1.ONO
WHERE     (dbo.tc_kunjungan.kode_bagian_tujuan = '050101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_update_LIS]");
    }
};
