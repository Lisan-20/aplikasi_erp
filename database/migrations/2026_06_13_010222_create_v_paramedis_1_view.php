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
        DB::statement("CREATE OR ALTER VIEW dbo.v_paramedis_1
AS
SELECT     dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.kode_paramedis, 
                      (dbo.tc_trans_pelayanan.bill_rs + dbo.tc_trans_pelayanan.bill_dr1) * 55 / 100 AS jasmed, dbo.tc_trans_pelayanan.kode_bagian
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.kode_paramedis > 0) AND (dbo.tc_trans_pelayanan.kode_bagian = '030901')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_paramedis_1]");
    }
};
