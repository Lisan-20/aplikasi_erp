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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_pasienpm_rad_v
AS
SELECT     dbo.pm_pasienpm_v.no_mr, dbo.pm_pasienpm_v.no_registrasi, dbo.pm_pasienpm_v.kode_bagian, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.pm_pasienpm_v.kode_penunjang, 
                      dbo.pm_pasienpm_v.kode_bagian_tujuan, dbo.pm_pasienpm_v.no_kunjungan
FROM         dbo.pm_pasienpm_v INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_pasienpm_v.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan AND dbo.pm_pasienpm_v.kode_bagian = dbo.tc_trans_pelayanan.kode_bagian
WHERE     (dbo.pm_pasienpm_v.kode_bagian = '050201')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pasienpm_rad_v]");
    }
};
