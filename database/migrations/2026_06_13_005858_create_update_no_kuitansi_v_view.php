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
        DB::statement("CREATE OR ALTER VIEW dbo.update_no_kuitansi_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, 
                      CASE WHEN LEN(DAY(dbo.tc_trans_kasir.tgl_jam)) = 1 THEN ('0' + CAST(DAY(dbo.tc_trans_kasir.tgl_jam) AS varchar(2))) ELSE DAY(dbo.tc_trans_kasir.tgl_jam) END AS tgl, 
                      LEN(DAY(dbo.tc_trans_kasir.tgl_jam)) AS karakter
FROM         dbo.no_kuitansi_sama_v INNER JOIN
                      dbo.tc_trans_kasir ON dbo.no_kuitansi_sama_v.seri_kuitansi = dbo.tc_trans_kasir.seri_kuitansi AND dbo.no_kuitansi_sama_v.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_no_kuitansi_v]");
    }
};
