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
        DB::statement("


CREATE OR ALTER VIEW dbo.ak_tc_transaksi_v
AS
SELECT     dbo.ak_tc_transaksi.id_ak_tc_transaksi, dbo.ak_tc_transaksi.no_bukti, dbo.ak_tc_transaksi.tgl_transaksi, dbo.ak_tc_transaksi_det.acc_no, 
                      dbo.ak_tc_transaksi_det.tipe_tx, dbo.ak_tc_transaksi_det.nominal
FROM         dbo.ak_tc_transaksi INNER JOIN
                      dbo.ak_tc_transaksi_det ON dbo.ak_tc_transaksi.id_ak_tc_transaksi = dbo.ak_tc_transaksi_det.id_ak_tc_transaksi



");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ak_tc_transaksi_v]");
    }
};
