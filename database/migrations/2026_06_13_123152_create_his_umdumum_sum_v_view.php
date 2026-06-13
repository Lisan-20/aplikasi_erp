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
        DB::statement("CREATE OR ALTER VIEW dbo.his_umdumum_sum_v
AS
SELECT     dbo.transaksi_umd.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.transaksi_umd.no_bukti, dbo.transaksi_umd.tgl_transaksi, 
                      COUNT(dbo.transaksi_umd.id_trans_umd) AS jml_brg, dbo.transaksi_umd.kode_supplier, dbo.transaksi_umd.inp_tgl, dbo.transaksi_umd.id_trans_umd, 
                      dbo.transaksi_umd.inp_id, dbo.transaksi_umd.acc_no_2, dbo.transaksi_umd.minggu, dbo.mt_supplier.namasupplier
FROM         dbo.mt_barang_nm INNER JOIN
                      dbo.transaksi_umd_detail ON dbo.mt_barang_nm.kode_brg = dbo.transaksi_umd_detail.kode_brg RIGHT OUTER JOIN
                      dbo.transaksi_umd INNER JOIN
                      dbo.mt_bagian ON dbo.transaksi_umd.kode_bagian COLLATE SQL_Latin1_General_CP1_CI_AS = dbo.mt_bagian.kode_bagian ON 
                      dbo.transaksi_umd_detail.id_trans_umd = dbo.transaksi_umd.id_trans_umd LEFT OUTER JOIN
                      dbo.mt_supplier ON dbo.transaksi_umd.kode_supplier = dbo.mt_supplier.kodesupplier
GROUP BY dbo.transaksi_umd.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.transaksi_umd.no_bukti, dbo.transaksi_umd.tgl_transaksi, dbo.transaksi_umd.kode_supplier, 
                      dbo.transaksi_umd.inp_tgl, dbo.transaksi_umd.id_trans_umd, dbo.transaksi_umd.inp_id, dbo.transaksi_umd.acc_no_2, dbo.transaksi_umd.minggu, 
                      dbo.mt_supplier.namasupplier
HAVING      (dbo.transaksi_umd.kode_bagian = '070101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [his_umdumum_sum_v]");
    }
};
