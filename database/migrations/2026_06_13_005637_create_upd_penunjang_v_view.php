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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_penunjang_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.status_selesai, dbo.pm_tc_penunjang.status_bayar, 
                      dbo.tc_trans_pelayanan.no_mr, dbo.pm_tc_penunjang.no_kunjungan
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.pm_tc_penunjang ON dbo.tc_trans_pelayanan.kode_penunjang = dbo.pm_tc_penunjang.kode_penunjang
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_penunjang_v]");
    }
};
