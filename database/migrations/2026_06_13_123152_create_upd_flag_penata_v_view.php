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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_flag_penata_v
AS
SELECT     no_registrasi, flag_penata, no_mr, tgl_transaksi, MONTH(tgl_transaksi) AS bln
FROM         dbo.tc_trans_pelayanan
WHERE     (NOT (no_registrasi IN
                          (SELECT     no_registrasi
                            FROM          dbo.fee_paramedis_temp))) AND (flag_penata = 1) AND (MONTH(tgl_transaksi) > 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_flag_penata_v]");
    }
};
