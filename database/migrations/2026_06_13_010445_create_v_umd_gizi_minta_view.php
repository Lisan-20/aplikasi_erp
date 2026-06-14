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
        DB::statement("CREATE OR ALTER VIEW dbo.v_umd_gizi_minta
AS
SELECT     dbo.transaksi_umd.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.transaksi_umd.no_bukti, dbo.transaksi_umd.tgl_transaksi, dbo.transaksi_umd_detail.kode_brg, dbo.mt_barang_nm.nama_brg, 
                      dbo.transaksi_umd_detail.harga_satuan, dbo.transaksi_umd_detail.jumlah_harga_netto, dbo.transaksi_umd_detail.harga_satuan_netto, dbo.transaksi_umd_detail.jumlah_harga, 
                      dbo.transaksi_umd.id_trans_umd, dbo.transaksi_umd_detail.satuan, dbo.transaksi_umd_detail.jumlah_besar_gizi AS jumlah_besar, dbo.transaksi_umd.kode_supplier, 
                      DAY(dbo.transaksi_umd.tgl_transaksi) AS tgl, MONTH(dbo.transaksi_umd.tgl_transaksi) AS bln, YEAR(dbo.transaksi_umd.tgl_transaksi) AS thn, dbo.mt_supplier.namasupplier
FROM         dbo.transaksi_umd INNER JOIN
                      dbo.transaksi_umd_detail ON dbo.transaksi_umd.id_trans_umd = dbo.transaksi_umd_detail.id_trans_umd INNER JOIN
                      dbo.mt_bagian ON dbo.transaksi_umd.kode_bagian COLLATE SQL_Latin1_General_CP1_CI_AS = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_barang_nm ON dbo.transaksi_umd_detail.kode_brg = dbo.mt_barang_nm.kode_brg INNER JOIN
                      dbo.mt_supplier ON dbo.transaksi_umd.kode_supplier = dbo.mt_supplier.kodesupplier
WHERE     (dbo.transaksi_umd.kode_bagian = '011301')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_umd_gizi_minta]");
    }
};
