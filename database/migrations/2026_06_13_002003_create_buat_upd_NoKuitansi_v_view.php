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
        DB::statement("CREATE OR ALTER VIEW dbo.buat_upd_NoKuitansi_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_kasir.tgl_jam, dbo.no_kuitansi_sama_v.no_kuitansi, DAY(dbo.tc_trans_kasir.tgl_jam) AS tgl, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.no_kuitansi_sama_v ON dbo.tc_trans_kasir.no_kuitansi = dbo.no_kuitansi_sama_v.no_kuitansi
GROUP BY dbo.tc_trans_kasir.tgl_jam, dbo.no_kuitansi_sama_v.no_kuitansi, DAY(dbo.tc_trans_kasir.tgl_jam), dbo.tc_trans_kasir.kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [buat_upd_NoKuitansi_v]");
    }
};
