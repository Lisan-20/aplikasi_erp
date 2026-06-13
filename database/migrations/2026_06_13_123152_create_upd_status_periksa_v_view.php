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
        DB::statement("CREATE VIEW dbo.upd_status_periksa_v
AS
SELECT     dbo.pl_tc_poli.kode_poli, dbo.pl_tc_poli.no_kunjungan, dbo.pl_tc_poli.status_periksa
FROM         dbo.pl_tc_poli INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pl_tc_poli.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan
WHERE     (dbo.pl_tc_poli.status_periksa = 0) AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_status_periksa_v]");
    }
};
