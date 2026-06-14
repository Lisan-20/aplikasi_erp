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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_anggaran_v
AS
SELECT     dbo.mt_anggaran.agg_nama, dbo.transaksi_umd.minggu, dbo.transaksi_umd.bulan, dbo.transaksi_umd.tahun, dbo.transaksi_umd.kode_bagian, 
                      SUM(dbo.transaksi_umd.jumlah_transaksi) AS jumlah_transaksi
FROM         dbo.mt_anggaran INNER JOIN
                      dbo.transaksi_umd ON dbo.mt_anggaran.agg_no = dbo.transaksi_umd.acc_no_2 COLLATE SQL_Latin1_General_CP1_CI_AS
GROUP BY dbo.mt_anggaran.agg_nama, dbo.transaksi_umd.minggu, dbo.transaksi_umd.bulan, dbo.transaksi_umd.tahun, dbo.transaksi_umd.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_anggaran_v]");
    }
};
