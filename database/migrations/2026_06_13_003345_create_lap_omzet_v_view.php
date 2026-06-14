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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_omzet_v
AS
SELECT     TOP (100) PERCENT dbo.mt_bagian.validasi, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, DAY(dbo.tc_trans_kasir.tgl_jam) 
                      AS tgl, dbo.tc_trans_kasir.status_batal AS Expr1, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.instalasi_omzet_v.status_batal
FROM         dbo.instalasi_omzet_v INNER JOIN
                      dbo.mt_bagian ON dbo.instalasi_omzet_v.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_trans_kasir ON dbo.instalasi_omzet_v.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.mt_bagian.validasi, MONTH(dbo.tc_trans_kasir.tgl_jam), DAY(dbo.tc_trans_kasir.tgl_jam), YEAR(dbo.tc_trans_kasir.tgl_jam), dbo.tc_trans_kasir.status_batal, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.instalasi_omzet_v.status_batal
HAVING      (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.instalasi_omzet_v.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_omzet_v]");
    }
};
